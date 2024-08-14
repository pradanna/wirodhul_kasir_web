<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use PDF;

class LaporanPemasukanController extends Controller
{
    public function index()
    {

        return view('kasir.laporanpemasukan');
    }

    public function cetakLaporanPemasukan()
    {
        $data = [
            // Data yang akan ditampilkan di PDF
            (object) ['nama_produk' => 'Produk A', 'jumlah' => 10, 'harga' => 10000, 'total' => 100000],
            (object) ['nama_produk' => 'Produk B', 'jumlah' => 5, 'harga' => 20000, 'total' => 100000],
        ];

        // Load view dan kirimkan data ke view tersebut
        $pdf = PDF::loadView('kasir.cetaklaporanpemasukan', compact('data'));

        // Menghasilkan file PDF dan mengunduhnya
        return $pdf->stream('laporan-penjualan.pdf');
    }
}
