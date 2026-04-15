<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman; 
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailPeminjaman; 
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['anggota', 'detail.buku']);

        if ($request->search) {
            $search = $request->search;
            $query->whereHas('anggota', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nipd', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%')
                  ->orWhere('jurusan', 'like', '%' . $search . '%');
            })
            ->orWhereHas('detail.buku', function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%');
            });
        }

        $peminjaman = $query->orderBy('created_at', 'desc')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $m_anggotas = Anggota::all();
        $m_bukus = Buku::all();
        return view('peminjaman.create', compact('m_anggotas', 'm_bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'      => 'required|exists:m_anggotas,id',
            'buku_id'         => 'required|array|min:1',
            'buku_id.*'       => 'exists:m_bukus,buku_id',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        // Cek duplikat peminjaman aktif
        foreach ($request->buku_id as $b_id) {
            $cekDuplikat = DB::table('detail_peminjaman')
                ->join('peminjaman', 'detail_peminjaman.id_transaksi', '=', 'peminjaman.id_transaksi')
                ->where('peminjaman.anggota_id', $request->anggota_id)
                ->where('detail_peminjaman.buku_id', $b_id) // PERBAIKAN: Spasi dihapus
                ->where('peminjaman.status', 'dipinjam')
                ->exists();

            if ($cekDuplikat) {
                return back()->withInput()->with('error', 'Gagal: Anggota sudah terdaftar ditable!!!!!!');
            }
        }

        DB::beginTransaction();
        try {
            // Simpan Header Peminjaman
            $peminjaman = Peminjaman::create([
                'anggota_id'      => $request->anggota_id,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => 'dipinjam',
                'denda'           => 0
            ]);

            // Simpan Detail untuk setiap buku yang dipilih
            foreach ($request->buku_id as $b_id) {
                $buku = Buku::where('buku_id', $b_id)->first();
                DetailPeminjaman::create([
                    'id_transaksi' => $peminjaman->id_transaksi, 
                    'buku_id'      => $b_id,
                    'kondisi'      => 'dipinjam',
                    'no_seri'      => $buku->no_seri ?? '-'
                ]);
            }

            DB::commit();
            return redirect()->route('peminjaman.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    public function updateDetail(Request $request, $id_detail)
    {
        $detail = DetailPeminjaman::findOrFail($id_detail);
        $detail->update(['kondisi' => $request->kondisi]);

        $peminjaman = Peminjaman::with('detail')->findOrFail($detail->id_transaksi);

        $dendaTelat = 0;
        $dendaKondisi = 0;

        $batas = Carbon::parse($peminjaman->tanggal_kembali);
        $waktuAcuan = $peminjaman->tanggal_dikembalikan ? Carbon::parse($peminjaman->tanggal_dikembalikan) : Carbon::now();

        if ($waktuAcuan->gt($batas)) {
            $hariTelat = $waktuAcuan->diffInDays($batas);
            $dendaTelat = $hariTelat * 1000;
        }

        foreach ($peminjaman->detail as $item) {
            if ($item->kondisi == 'rusak') $dendaKondisi += 10000;
            if ($item->kondisi == 'hilang') $dendaKondisi += 50000;
        }

        $peminjaman->update([
            'denda' => $dendaTelat + $dendaKondisi
        ]);

        return redirect()->back()->with('success', 'Denda diperbarui otomatis!');
    }

    public function kembalikan($id_transaksi)
    {
        $peminjaman = Peminjaman::with('detail')->findOrFail($id_transaksi);
        $hariIni = Carbon::now();
        $batas = Carbon::parse($peminjaman->tanggal_kembali);
        
        $totalDenda = 0;

        // Hitung denda keterlambatan
        if ($hariIni->gt($batas)) {
            $hariTelat = $hariIni->diffInDays($batas);
            $totalDenda = $hariTelat * 1000; 
        }

        foreach ($peminjaman->detail as $detail) {
            // Hitung denda kondisi jika sudah rusak/hilang sebelumnya
            if ($detail->kondisi == 'rusak') {
                $totalDenda += 10000;
            } elseif ($detail->kondisi == 'hilang') {
                $totalDenda += 50000;
            } else {
                // Jika normal, ubah status menjadi dikembalikan
                $detail->update(['kondisi' => 'dikembalikan']);
            }
        }

        $peminjaman->update([
            'tanggal_dikembalikan' => $hariIni->toDateString(),
            'status' => 'dikembalikan',
            'denda' => $totalDenda 
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Buku Kembali!');
    }

    public function destroy($id_transaksi)
    {
        $peminjaman = Peminjaman::findOrFail($id_transaksi);
        $peminjaman->detail()->delete();
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data dihapus');
    }

    public function cetak()
    {
        $peminjaman = Peminjaman::with(['anggota', 'detail.buku'])->orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('peminjaman.laporanpeminjaman', compact('peminjaman'));
        $pdf->setPaper('a4', 'landscape'); 

        return $pdf->stream('laporan-peminjaman.pdf');
    }
}