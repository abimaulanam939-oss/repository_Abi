<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Buku;

class HomeController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::count();

        return view('home', compact('totalAnggota', 'totalBuku'));
    }
}