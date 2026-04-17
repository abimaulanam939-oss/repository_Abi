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
    public function edit($buku_id)
    {
        $m_bukus = Buku::findOrFail($buku_id);

        return view('buku.edit', compact('m_bukus'));
    }

    // Update buku
    public function update(Request $request, $id)
    {
        $m_bukus = Buku::findOrFail($id);

        $request->validate([
            'judul'   => 'required',
            'no_seri' => 'required|unique:m_bukus,no_seri,'.$id.',buku_id'
        ]);

        $m_bukus->update([
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
        $m_bukus = Buku::findOrFail($buku_id);

         try {
            $m_bukus->delete();
            return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->route('buku.index')->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
        $m_bukus->detail()->delete();
        $m_bukus ->delete();
    }
}