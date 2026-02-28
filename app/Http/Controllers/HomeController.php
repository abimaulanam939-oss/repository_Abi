<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaksi;

class HomeController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::count();
        $totalTransaksi = \App\Models\Transaksi::count();
        return view('dashboard.home', compact('totalAnggota', 'totalBuku'));

    }
}