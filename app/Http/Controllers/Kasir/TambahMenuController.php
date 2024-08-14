<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;

class TambahMenuController extends Controller
{
    public function index()
    {

        return view('kasir.tambahmenu');
    }
}
