<?php


namespace App\Http\Controllers\Cashier;


use App\Helper\CustomController;
use App\Models\Cart;
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
        return view('cashier.dashboard');
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
}
