<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ControllerAuth extends Controller
{
    
    public function index(){
        return view('login');
    }

     public function cek_akun(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = User::where('name',$request->username)->first();               

        if(!$user){
            return redirect()->route('login')->with('pesan','gagal');
        }

        if(!Hash::check($request->password,$user->password)){
            return redirect()->route('login')->with('pesan','gagal login');
        }
        
        Auth::login($user);

        return redirect()->route('dashboard');
        
    }
}