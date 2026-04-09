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
        // Eager Loading agar query efisien
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
                // AMBIL no_seri dari tabel buku (m_bukus)
                $buku = Buku::findOrFail($b_id);

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi, 
                    'buku_id'      => $b_id,
                    'kondisi'      => 'dipinjam',
                    'no_seri'      => $buku->no_seri // <-- No seri otomatis masuk ke detail
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
     * Update kondisi buku satuan dari Index
     */
    public function updateDetail(Request $request, $id_detail)
    {
        $detail = DetailTransaksi::findOrFail($id_detail);
        $detail->update(['kondisi' => $request->kondisi]);

        // Hitung ulang total denda transaksi ini
        $transaksi = Transaksi::with('detail')->findOrFail($detail->id_transaksi);
        $totalDenda = 0;

        // 1. Denda Kerusakan/Hilang
        foreach ($transaksi->detail as $item) {
            if ($item->kondisi == 'rusak') $totalDenda += 10000;
            if ($item->kondisi == 'hilang') $totalDenda += 50000;
        }

        // 2. Denda Keterlambatan
        $batas = Carbon::parse($transaksi->tanggal_kembali);
        if (now()->gt($batas) && $transaksi->status == 'dipinjam') {
            $hariTelat = now()->diffInDays($batas);
            $totalDenda += ($hariTelat * 1000);
        }

        $transaksi->update(['denda' => $totalDenda]);

        return redirect()->back()->with('success', 'Kondisi buku dan denda diperbarui!');
    }

    public function kembalikan($id_transaksi)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id_transaksi);
        $hariIni = Carbon::now();
        
        // Logika update status header
        $transaksi->update([
            'tanggal_dikembalikan' => $hariIni->format('Y-m-d'),
            'status' => 'dikembalikan'
        ]);

        // Semua buku otomatis jadi 'dikembalikan' jika admin klik tombol kembali utama
        foreach ($transaksi->detail as $detail) {
            $detail->update(['kondisi' => 'dikembalikan']);
        }

        return redirect()->route('transaksi.index')->with('success', 'Buku berhasil dikembalikan');
    }

    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->detail()->delete(); // Hapus detail dulu
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Data dihapus');
    }
}