<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;        // GANTI INI: Dari m_buku menjadi Buku
use App\Models\Peminjaman; 

class PageController extends Controller
{
    public function home()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::count(); // GANTI INI JUGA: Menggunakan Buku
        $totalPeminjaman = Peminjaman::count();

        // Ambil data histori
        $recentPeminjaman = Peminjaman::with(['anggota', 'detail.buku'])
                            ->latest()
                            ->take(5)
                            ->get();

        return view('dashboard.home', compact(
            'totalAnggota',
            'totalBuku',
            'totalPeminjaman',
            'recentPeminjaman'
        ));
    }
}