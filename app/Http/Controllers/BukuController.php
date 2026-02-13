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

    // Simpan data buku baru
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        // Simpan manual (tanpa mass assignment)
        $bukus = new Buku();
        $bukus->judul = $request->judul;
        $bukus->penulis = $request->penulis;
        $bukus->penerbit = $request->penerbit;
        $bukus->tahun = $request->tahun;
        $bukus->stok = $request->stok;
        $bukus->save();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    // Tampilkan form edit buku
    public function edit($id)
    {
        $bukus = Buku::findOrFail($id);
        return view('buku.edit', compact('bukus'));
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $bukus = Buku::findOrFail($id);
        $bukus->judul = $request->judul;
        $bukus->penulis = $request->penulis;
        $bukus->penerbit = $request->penerbit;
        $bukus->tahun = $request->tahun;
        $bukus->stok = $request->stok;
        $bukus->save();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    // Hapus buku
    public function destroy($id)
    {
        $bukus = Buku::findOrFail($id);
        $bukus->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}