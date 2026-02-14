<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function proses(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // Contoh login sederhana (tanpa database dulu)
        if ($username == "admin" && $password == "123") {
            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'Username atau Password salah');
        }
    }

    public function dashboard()
    {
        return "Login Berhasil 🎉";
    }
}