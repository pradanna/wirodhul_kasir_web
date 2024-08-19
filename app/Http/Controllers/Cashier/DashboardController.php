<?php


namespace App\Http\Controllers\Cashier;


use App\Helper\CustomController;
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
            $param = $this->field('param');
            $data = Menu::with([])
                ->where('name', 'LIKE', '%' . $param . '%')
                ->get();
            return $this->jsonSuccessResponse('success', $data);
        }
        return view('cashier.dashboard');
    }
}
