<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;

class PengeluaranController extends Controller
{
    public function index()
    {

        return view('kasir.pengeluaran');
    }
}
