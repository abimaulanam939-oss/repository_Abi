<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    // Tampilkan semua buku
    public function index()
    {
        $bukus = Buku::all();
        return view('buku.index', compact('bukus'));
    }

    // Tampilkan form tambah buku
    public function create()
    {
        return view('buku.create');
    }

    // Simpan data buku
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required|integer',
            'stok'      => 'required|integer|min:0',
        ]);

        Buku::create([
            'judul'     => $request->judul,
            'penulis'   => $request->penulis,
            'penerbit'  => $request->penerbit,
            'tahun'     => $request->tahun,
            'stok'      => $request->stok,
        ]);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil ditambahkan');
    }

    // Form edit
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required|integer',
            'stok'      => 'required|integer|min:0',
        ]);

        $buku->update([
            'judul'     => $request->judul,
            'penulis'   => $request->penulis,
            'penerbit'  => $request->penerbit,
            'tahun'     => $request->tahun,
            'stok'      => $request->stok,
        ]);

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil diupdate');
    }

    // Hapus
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil dihapus');
    }
}
