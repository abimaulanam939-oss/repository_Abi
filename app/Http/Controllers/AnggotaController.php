<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    // Tampilkan semua anggota
    public function index()
    {
        $anggotas = Anggota::all();
        return view('anggota.index', compact('anggotas'));
    }

    // Tampilkan form tambah anggota
    public function create()
    {
        return view('anggota.create');
    }

    // Simpan data anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required'
        ]);

        $anggotas = new Anggota();
        $anggotas->nama = $request->nama;
        $anggotas->alamat = $request->alamat;
        $anggotas->telepon = $request->telepon;
        $anggotas->save();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    // Tampilkan form edit anggota
    public function edit($id)
    {
        $anggotas = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggotas'));
    }

    // Update data anggota
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required'
        ]);

        $anggotas = Anggota::findOrFail($id);
        $anggotas->nama = $request->nama;
        $anggotas->alamat = $request->alamat;
        $anggotas->telepon = $request->telepon;
        $anggotas->save();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil diupdate');
    }

    // Hapus anggota
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}