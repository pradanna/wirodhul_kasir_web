<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Transaction;

class LaporanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->request->ajax()) {
            $start = $this->field('start');
            $end = $this->field('end');
            $data = Transaction::with(['member'])
                ->whereBetween('date', [$start, $end])
                ->orderBy('created_at', 'ASC')
                ->get();
            return $this->basicDataTables($data);
        }
        return view('admin.laporan.index');
    }

    public function pdf()
    {
        $start = $this->field('start');
        $end = $this->field('end');
        $data =Transaction::with(['member'])
            ->whereBetween('date', [$start, $end])
            ->orderBy('created_at', 'ASC')
            ->get();
        return $this->convertToPdf('admin.laporan.cetak', [
            'data' => $data,
            'start' => $start,
            'end' => $end
        ]);

    }
}
