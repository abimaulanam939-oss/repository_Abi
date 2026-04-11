<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class BukuController extends Controller
{
    // Tampilkan semua buku + search
    public function index(Request $request)
    {
        $query = Buku::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('no_seri', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%");
            });
        }

        // Pakai m_bukus agar sinkron dengan View
        $m_bukus = $query->get();

        return view('buku.index', compact('m_bukus'));
    }

    // Form tambah buku
    public function create()
    {
        return view('buku.create');
    }

    // Simpan buku
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required',
            'no_seri' => 'required|unique:m_bukus,no_seri'
        ]);

        Buku::create([
            'judul'           => $request->judul,
            'no_seri'         => $request->no_seri,
            'pengarang'       => $request->pengarang,
            'penerbit'        => $request->penerbit,
            'tahun_terbit'    => $request->tahun_terbit,
            'jumlah_halaman'  => $request->jumlah_halaman,
        ]);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil ditambahkan');
    }

    // Form edit buku
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.edit', compact('buku'));
    }

    // Update buku
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul'   => 'required',
            'no_seri' => 'required|unique:m_bukus,no_seri,'.$id.',buku_id'
        ]);

        $buku->update([
            'judul'           => $request->judul,
            'no_seri'         => $request->no_seri,
            'pengarang'       => $request->pengarang,
            'penerbit'        => $request->penerbit,
            'tahun_terbit'    => $request->tahun_terbit,
            'jumlah_halaman'  => $request->jumlah_halaman,
        ]);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil diupdate');
    }

    // Hapus buku (DENGAN PROTEKSI ERROR)
    public function destroy($buku_id)
    {
        try {
            // Kita gunakan DB Transaction agar aman
            DB::transaction(function () use ($buku_id) {
                
                // LANGKAH 1: Hapus dulu data di tabel detail_transaksis
                // Ini untuk melepas "kunci" Foreign Key
                DB::table('detail_transaksis')->where('buku_id', $buku_id)->delete();

                // LANGKAH 2: Cari data buku di tabel m_bukus
                $buku = Buku::findOrFail($buku_id);
                
                // LANGKAH 3: Hapus bukunya
                $buku->delete();
            });

            // Jika berhasil, balik ke halaman daftar buku
            return redirect()->route('buku.index')->with('success', 'Buku dan riwayat transaksinya berhasil dihapus!');

        } catch (\Exception $e) {
            // Jika gagal (misal ada error koneksi), balik ke index dengan pesan error
            return redirect()->route('buku.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}