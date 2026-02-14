<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Buku;

class PageController extends Controller
{
    public function home()
    {
        $totalAnggota = Anggota::count();
        $totalBuku = Buku::count();
    

        return view('dashboard.home', compact('totalAnggota', 'totalBuku'));
    }
}