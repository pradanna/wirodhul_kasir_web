<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // if (request()->method() == 'POST') {
        //     return $this->postLogin();
        // }

        return view('auth.login');
    }

    public function postLogin()
    {
        $field = \request()->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string',
            ]
        );
        //            $user = User::where('username', $field['username'])->first();
        //            if ($user && Hash::check($field['password'], $user->password)){
        //                return redirect('/admin');
        //            }
        if ($this->isAuth($field)) {
            if (\auth()->user()->isActive == false) {
                Auth::logout();
                return redirect()->back()->withInput()->withErrors(
                    [
                        'username' => 'User non aktif'
                    ]
                );
            }
            $role     = \auth()->user()->role;
            if ($role !== 'cs') {
                Auth::logout();
                return redirect()->back()->withInput()->withErrors(
                    [
                        'username' => 'Akun tidak sesuai'
                    ]
                );
            }

            //            return response()->json();

            return redirect('/admin');
        }

        return redirect()->back()->withcErrors(['password' => 'Password mismach.'])->withInput();
    }

    /**
     * @param $credentials
     *
     * @return bool
     */
    public function isAuth($credentials = [])
    {
        if (count($credentials) > 0 && Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
