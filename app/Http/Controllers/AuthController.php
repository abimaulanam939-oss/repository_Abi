<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Tambahkan ini di atas agar bisa pakai Model User

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

    // --- TAMBAHKAN KODE BARU DI BAWAH INI ---

    public function register()
    {
        return view('login.register'); // Pastikan kamu buat file register.blade.php
    }

    public function storeRegister(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed', 
        ]);

        // Simpan data ke tabel users
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => $request->password, // Otomatis ter-hash karena cast 'hashed' di Model
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat!');
    }
}