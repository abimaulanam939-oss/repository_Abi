<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
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
                  ->orWhere('no_seri', 'like', "%{$search}%");
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
            'no_seri' => 'required'
        ]);

        Buku::create([
            'judul'   => $request->judul,
            'no_seri' => $request->no_seri,
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
            'no_seri' => 'required'
        ]);

        $buku->update([
            'judul'   => $request->judul,
            'no_seri' => $request->no_seri,
        ]);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil diupdate');
    }

    // Hapus buku (DENGAN PROTEKSI ERROR)
   public function destroy($id_buku)
    {
        $buku = Buku::findOrFail($id_buku);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data dihapus');
    }
}