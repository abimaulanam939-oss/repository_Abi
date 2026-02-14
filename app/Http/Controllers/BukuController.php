<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

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
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
            });
        }

        $bukus = $query->get();

        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required',
            'pengarang' => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required'
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil ditambahkan');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul'     => 'required',
            'pengarang' => 'required',
            'penerbit'  => 'required',
            'tahun'     => 'required'
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Data buku berhasil dihapus');
    }
}
