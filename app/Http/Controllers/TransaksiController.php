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
        // 1. Validasi harus menyertakan tanggal karena di Blade kita buat input tanggal
        $request->validate([
            'anggota_id' => 'required',
            'buku_id'    => 'required|array',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date'
        ]);

        DB::beginTransaction();

        try {
            // 2. Gunakan data dari $request agar tanggal sesuai pilihan di form
            $transaksi = Transaksi::create([
                'anggota_id'      => $request->anggota_id,
                'tanggal_pinjam'  => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status'          => 'dipinjam',
                'denda'           => 0
            ]);

            // 3. Pastikan mengambil value ID yang benar untuk looping
            foreach ($request->buku_id as $buku_id) {
                DetailTransaksi::create([
                    // Pakai id_transaksi karena itu Primary Key di model/table kamu
                    'id_transaksi' => $transaksi->id_transaksi, 
                    'buku_id'      => $buku_id,
                    'kondisi'      => 'dipinjam'
                ]);
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Kembalikan pesan error asli supaya kamu tahu kalau ada kolom yang kurang di $fillable
            return back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    // Fungsi lainnya (kembalikan, hilang, rusak, destroy) sudah cukup oke, 
    // tapi pastikan penulisan ID konsisten.
    
    public function kembalikan($id_transaksi)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id_transaksi);
        $hariIni = Carbon::now();
        $batas = Carbon::parse($transaksi->tanggal_kembali);

        $denda = 0;
        if ($hariIni->gt($batas)) {
            $telat = $hariIni->diffInDays($batas);
            $denda = $telat * 1000;
        }

        $transaksi->update([
            'tanggal_dikembalikan' => $hariIni->format('Y-m-d'),
            'status' => 'dikembalikan',
            'denda'  => $transaksi->denda + $denda
        ]);

        foreach ($transaksi->detail as $detail) {
            $detail->update(['kondisi' => 'dikembalikan']);
        }

        return redirect()->route('transaksi.index')->with('success', 'Buku berhasil dikembalikan');
    }

    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id_transaksi);
        
        // Hapus detail dulu baru headernya (karena ada Foreign Key)
        $transaksi->detail()->delete();
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Data berhasil dihapus');
    }
}