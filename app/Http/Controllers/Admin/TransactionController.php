<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $now = Carbon::now()->format('Y-m-d');
            $data = Transaction::with(['member'])
                ->where('date', '=', $now)
                ->orderBy('created_at', 'DESC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.transaction.index');
    }
}
