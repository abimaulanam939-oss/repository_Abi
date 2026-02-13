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

    // Simpan data anggota ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email',
            'no_hp'  => 'required',
            'alamat' => 'required',
        ]);

        Anggota::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('anggota.index')
                         ->with('success', 'Data anggota berhasil ditambahkan');
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
        $anggotas = Anggota::findOrFail($id);

        $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email',
            'no_hp'  => 'required',
            'alamat' => 'required',
        ]);

        $anggotas->update([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'no_hp'  => $request->no_hp,
            'alamat' => $request->alamat,
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