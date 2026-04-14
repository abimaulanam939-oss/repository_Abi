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
                  ->orWhere('nipd', 'like', "%{$search}%") // Pencarian berdasarkan NIPD
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
            'nipd'    => 'required|unique:m_anggotas,nipd', // Validasi unik
            'kelas'   => 'required',
            'jurusan' => 'required',
        ]);

        Anggota::create([
            'nama'    => $request->nama,
            'nipd'    => $request->nipd, 
            'kelas'   => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil ditambahkan');
    }

    // Tampilkan form edit anggota
    public function edit($id)
    {
        $m_anggotas = Anggota::findOrFail($id);

        return view('anggota.edit', compact('m_anggotas'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $m_anggotas = Anggota::findOrFail($id);

        $request->validate([
            'nama'    => 'required',
            'nipd'    => 'required|unique:m_anggotas,nipd,'.$id, // Unik kecuali milik sendiri
            'kelas'   => 'required',
            'jurusan' => 'required',
        ]);

        $m_anggotas->update([
            'nama'    => $request->nama,
            'nipd'    => $request->nipd, 
            'kelas'   => $request->kelas,
            'jurusan' => $request->jurusan,
        ]);

        // SUDAH DIPERBAIKI: Dari 'angagota.index' menjadi 'anggota.index'
        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil diupdate');
    }

    // Hapus anggota
    public function destroy($id)
    {
        $m_anggotas = Anggota::findOrFail($id);
        $m_anggotas->delete();

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil dihapus');
    }
}