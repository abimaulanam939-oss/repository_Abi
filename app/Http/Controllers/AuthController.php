<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {

            session([
                'login' => true,
                'user' => $user->username
            ]);

            return redirect('/home');
        }

        return back()->with('error','Username / Password salah');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}