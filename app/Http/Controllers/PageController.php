<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Transaksi;

class PageController extends Controller
{
    public function home()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::count();
        $totalTransaksi = Transaksi::count();

        // tambah ini ↓↓↓
        $transaksiTerakhir = Transaksi::latest()->take(5)->get();

        return view('dashboard.home', compact(
            'totalAnggota',
            'totalBuku',
            'totalTransaksi',
            'transaksiTerakhir'
        ));
    }
}