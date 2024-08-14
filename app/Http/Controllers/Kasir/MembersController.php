<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    public function index()
    {

        return view('kasir.members');
    }
}
