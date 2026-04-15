<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPeminjaman; // Memanggil model yang benar
use App\Models\Peminjaman;

class DetailPeminjamanController extends Controller
{
    public function update(Request $request, $id_detail)
    {
        // 1. Ambil data detail menggunakan model
        $detail = DetailPeminjaman::findOrFail($id_detail);

        // 2. Update kondisi buku
        $detail->update([
            'kondisi' => $request->kondisi
        ]);

        // 3. Hitung ulang denda pada tabel induk peminjaman
        $peminjaman = Peminjaman::with('detail')->findOrFail($detail->id_transaksi);

        $dendaTotal = 0;
        foreach ($peminjaman->detail as $d) {
            if ($d->kondisi == 'rusak') {
                $dendaTotal += 10000;
            } elseif ($d->kondisi == 'hilang') {
                $dendaTotal += 50000;
            }
        }

        // 4. Simpan total denda baru
        $peminjaman->update([
            'denda' => $dendaTotal
        ]);

        return redirect()->back()->with('success', 'Status buku dan denda diperbarui!');
    }
}