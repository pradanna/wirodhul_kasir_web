<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    private $rule = [
        'username' => 'required',
        'password' => 'required',
    ];

    private $message = [
        'username.required' => 'kolom username wajib di isi',
        'password.required' => 'kolom password wajib di isi',
    ];

    public function login()
    {
        if ($this->request->method() === 'POST') {
            $validator = Validator::make($this->request->all(), $this->rule, $this->message);
            if ($validator->fails()) {
                return redirect()->back()->with('failed', 'harap mengisi kolom dengan benar...')->withErrors($validator)->withInput();
            }

            $credentials = [
                'username' => $this->postField('username'),
                'password' => $this->postField('password')
            ];


            if ($this->isAuth($credentials)) {
                $role = \auth()->user()->role;
                if ($role !== 'cashier') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('cashier.dashboard');
            }
            return redirect()->back()->with('failed', 'Periksa Kembali Username dan Password Anda');
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
