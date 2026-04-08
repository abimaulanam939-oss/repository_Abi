<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;

class DetailTransaksiController extends Controller
{
    public function update(Request $request, $id)
    {
        $detail = DetailTransaksi::findOrFail($id);

        // update kondisi buku
        $detail->update([
            'kondisi' => $request->kondisi
        ]);

        // ambil transaksi
        $transaksi = Transaksi::with('detail')->find($detail->id_transaksi);

        $denda = 0;

        // hitung ulang denda dari semua buku
        foreach ($transaksi->detail as $d) {

            if ($d->kondisi == 'rusak') {
                $denda += 10000;
            }

            if ($d->kondisi == 'hilang') {
                $denda += 50000;
            }
        }

        // simpan ke database
        $transaksi->update([
            'denda' => $denda
        ]);

        return redirect()->back();
    }
}