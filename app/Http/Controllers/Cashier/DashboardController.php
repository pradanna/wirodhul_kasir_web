<?php


namespace App\Http\Controllers\Cashier;


use App\Helper\CustomController;
use App\Models\Cart;
use App\Models\DiscountSetting;
use App\Models\Member;
use App\Models\Menu;

class DashboardController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {

            if ($this->request->method() === 'POST') {
                $id = $this->postField('id');
                return $this->destroy_cart($id);
            }
            $param = $this->field('param');
            $type = $this->field('type');
            if ($type === 'product') {
                $data = Menu::with([])
                    ->where('name', 'LIKE', '%' . $param . '%')
                    ->get();
                return $this->jsonSuccessResponse('success', $data);
            }

            if ($type === 'detail') {
                $productID = $this->field('id');
                $data = Menu::with([])
                    ->where('id', '=', $productID)
                    ->first();
                return $this->jsonSuccessResponse('success', $data);
            }

            if ($type === 'cart') {
                $data = Cart::with(['menu'])
                    ->whereNull('transaction_id')
                    ->get();
                return $this->jsonSuccessResponse('success', $data);
            }


            return $this->jsonSuccessResponse('success');

        }

        $members = Member::with([])
            ->get();
        return view('cashier.dashboard')->with([
            'members' => $members
        ]);
    }

    private function destroy_cart($id)
    {
        try {
            Cart::destroy($id);
            return $this->jsonSuccessResponse('Berhasil menghapus data...');
        } catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    public function addToCart()
    {
        try {
            $menuID = $this->postField('id');
            $qty = $this->postField('qty');

            $menu = Menu::with([])
                ->where('id', '=', $menuID)
                ->first();
            if (!$menu) {
                return $this->jsonNotFoundResponse('belum memilih menu...');
            }

            $price = $menu->price;
            $total = $qty * $price;
            $data_request = [
                'menu_id' => $menuID,
                'transaction_id' => null,
                'price' => $price,
                'qty' => $qty,
                'total' => $total
            ];

            Cart::create($data_request);
            return $this->jsonSuccessResponse('success');
        }catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }

    public function get_discount()
    {
        try {
            $carts = Cart::with([])
                ->whereNull('transaction_id')
                ->get();

            $total = $carts->sum('total');
            $discountSettings = DiscountSetting::with([])
                ->where('nominal','>=', $total)
                ->orderBy('nominal','ASC')
                ->first();

            $discount = 0;
            if ($discountSettings) {
                $discountValue = $discountSettings->discount;
                $discount = ($total * $discountValue) / 100;
            }

            return $this->jsonSuccessResponse('success', $discount);
        }catch (\Exception $e) {
            return $this->jsonErrorResponse();
        }
    }
}
