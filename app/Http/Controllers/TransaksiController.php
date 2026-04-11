<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with(['anggota', 'detail.buku']);

        if ($request->search) {
            $search = $request->search;
            $query->whereHas('anggota', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%')
                  ->orWhere('jurusan', 'like', '%' . $search . '%');
            })
            ->orWhereHas('detail.buku', function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%');
            });
        }

        $transaksis = $query->orderBy('created_at', 'desc')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $m_anggotas = Anggota::all();
        $m_bukus = Buku::all();
        return view('transaksi.create', compact('m_anggotas', 'm_bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'buku_id'    => 'required|array',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date'
        ]);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::create([
                'anggota_id'      => $request->anggota_id,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => 'dipinjam',
                'denda'           => 0
            ]);

            foreach ($request->buku_id as $b_id) {
                $buku = Buku::findOrFail($b_id);

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi, 
                    'buku_id'      => $b_id,
                    'kondisi'      => 'dipinjam',
                    'no_seri'      => $buku->no_seri
                ]);
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    /**
     * Update kondisi buku satuan dan hitung denda secara real-time
     */
  public function updateDetail(Request $request, $id_detail)
{
    $detail = DetailTransaksi::findOrFail($id_detail);
    $detail->update(['kondisi' => $request->kondisi]);

    // Ambil data transaksi induknya
    $transaksi = Transaksi::with('detail')->findOrFail($detail->id_transaksi);
    
    $dendaTelat = 0;
    $dendaKondisi = 0;

    // 1. HITUNG DENDA TELAT (Berdasarkan tgl hari ini vs tgl kembali)
    $batas = Carbon::parse($transaksi->tanggal_kembali);
    // Jika sudah dikembalikan, pakai tgl kembali asli. Jika belum, pakai waktu sekarang.
    $waktuAcuan = $transaksi->tanggal_dikembalikan ? Carbon::parse($transaksi->tanggal_dikembalikan) : Carbon::now();

    if ($waktuAcuan->gt($batas)) {
        $hariTelat = $waktuAcuan->diffInDays($batas);
        $dendaTelat = $hariTelat * 1000;
    }

    // 2. HITUNG DENDA KONDISI SEMUA BUKU
    foreach ($transaksi->detail as $item) {
        if ($item->kondisi == 'rusak') $dendaKondisi += 10000;
        if ($item->kondisi == 'hilang') $dendaKondisi += 50000;
    }

    // 3. UPDATE TOTAL DENDA KE TABEL TRANSAKSI
    $transaksi->update([
        'denda' => $dendaTelat + $dendaKondisi
    ]);

    return redirect()->back()->with('success', 'Denda diperbarui otomatis!');
}

    /**
     * Logika Pengembalian Total
     */
  public function kembalikan($id_transaksi)
{
    $transaksi = Transaksi::with('detail')->findOrFail($id_transaksi);
    $hariIni = Carbon::now();
    $batas = Carbon::parse($transaksi->tanggal_kembali);
    
    // Mulai dari nol
    $totalDenda = 0;

    // 1. HITUNG DENDA TELAT (Hanya dihitung jika tgl hari ini lewat batas)
    if ($hariIni->gt($batas)) {
        $hariTelat = $hariIni->diffInDays($batas);
        $totalDenda = $hariTelat * 1000; 
    }

    // 2. HITUNG & TAMBAHKAN DENDA KONDISI BUKU
    foreach ($transaksi->detail as $detail) {
        if ($detail->kondisi == 'rusak') {
            $totalDenda += 10000; // Tambah 10rb ke denda yang sudah ada
        } elseif ($detail->kondisi == 'hilang') {
            $totalDenda += 50000; // Tambah 50rb ke denda yang sudah ada
        } else {
            // Jika statusnya masih 'dipinjam', ubah jadi 'dikembalikan'
            $detail->update(['kondisi' => 'dikembalikan']);
        }
    }

    // 3. SIMPAN KE DATABASE
    $transaksi->update([
        'tanggal_dikembalikan' => $hariIni->toDateString(),
        'status' => 'dikembalikan',
        'denda' => $totalDenda // Hasil akhir gabungan telat + kondisi
    ]);

    return redirect()->route('transaksi.index')->with('success', 'Buku Kembali. Total Denda (Telat + Kondisi): Rp ' . number_format($totalDenda));
}

    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->detail()->delete();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Data dihapus');
    }
}