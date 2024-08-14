<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use PDF;

class KasirController extends Controller
{
    public function index()
    {

        return view('kasir.dashboard');
    }

    public function cetakNota()
    {
        $data = [
            // Data yang akan ditampilkan di PDF
            (object) ['nama_produk' => 'Produk A', 'jumlah' => 10, 'harga' => 10000, 'total' => 100000],
            (object) ['nama_produk' => 'Produk B', 'jumlah' => 5, 'harga' => 20000, 'total' => 100000],
        ];

        $pdf = PDF::loadView('kasir.nota', compact('data'))
            ->setPaper([0, 0, 350, 567.72], 'portrait');

        // Menghasilkan file PDF dan mengunduhnya
        return $pdf->stream('laporan-penjualan.pdf');
    }
}
