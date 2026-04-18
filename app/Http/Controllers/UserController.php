<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        // Mengambil semua data user untuk ditampilkan di tabel
        $users = User::all(); 

        return view('user.index', compact('users'));
    }

    /**
     * Menampilkan form untuk menambah pengguna baru.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Menyimpan pengguna baru ke dalam database.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'username' => 'required|unique:users',
        'password' => 'required|min:5',
        'role' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'username' => $request->username,
        // Buat email otomatis agar validasi database terpenuhi
        'email' => $request->username . '@perpustakaan.com', 
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
}

    /**
     * Menampilkan form untuk mengedit data pengguna.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        
        return view('user.edit', compact('user'));
    }

    /**
     * Memperbarui data pengguna di database.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Jika kolom password diisi, maka update passwordnya
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui');
    }

    /**
     * Menghapus pengguna dari database.
     */
   public function destroy(string $id)
{
    // Cari user berdasarkan ID
    $user = \App\Models\User::findOrFail($id);
    
    // Keamanan: Mencegah menghapus diri sendiri yang sedang login
    if ($user->id === auth()->id()) {
        return redirect()->back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri!');
    }

    // Eksekusi hapus
    $user->delete();

    // Kembali ke halaman index dengan pesan sukses
    return redirect()->route('user.index')->with('success', 'User berhasil dihapus dari sistem');
}
}