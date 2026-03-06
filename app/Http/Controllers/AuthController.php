<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AuthController extends Controller
{

    public function login()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == "admin" && $password == "12345") {
            return redirect('/home');
        }

        return back()->with('error','Username atau password salah');
    }


}