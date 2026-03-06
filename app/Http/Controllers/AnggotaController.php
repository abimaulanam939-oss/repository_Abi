<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    // Tampilkan semua anggota + search
    public function index(Request $request)
    {
        $query = Anggota::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('jurusan', 'like', "%{$search}%");
            });
        }

        $anggotas = $query->get();

        return view('anggota.index', compact('anggotas'));
    }

    // Tampilkan form tambah anggota
    public function create()
    {
        return view('anggota.create');
    }

    // Simpan data anggota
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required',
            'kelas'   => 'required',
            'jurusan' => 'required',
        ]);

        Anggota::create([
            'nama'    => $request->nama,
            'kelas'   => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil ditambahkan');
    }

    // Tampilkan form edit anggota
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('anggota.edit', compact('anggota'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $request->validate([
            'nama'    => 'required',
            'kelas'   => 'required',
            'jurusan' => 'required',
        ]);

        $anggota->update([
            'nama'    => $request->nama,
            'kelas'   => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil diupdate');
    }

    // Hapus anggota
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil dihapus');
    }
}