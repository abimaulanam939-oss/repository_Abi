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
        $search = $request->search;

        $transaksis = Transaksi::with('anggota', 'detail.buku')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('anggota', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('detail.buku', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                })
                ->orWhere('status', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksis', 'search'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        $bukus = Buku::where('stok', '>', 0)->get();

        return view('transaksi.create', compact('anggotas', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'buku_id' => 'required|array',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        DB::beginTransaction();

        try {
            $transaksi = Transaksi::create([
                'anggota_id' => $request->anggota_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => 'dipinjam',
                'denda' => 0
            ]);

            foreach ($request->buku_id as $id_buku) {
                $buku = Buku::findOrFail($id_buku);

                if ($buku->stok <= 0) {
                    throw new \Exception("Stok buku {$buku->judul} habis.");
                }

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'buku_id' => $id_buku
                ]);

                $buku->decrement('stok');
            }

            DB::commit();

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function kembalikan($id)
    {
        $transaksi = Transaksi::with('detail.buku')->findOrFail($id);

        if ($transaksi->status === 'dikembalikan') {
            return redirect()->back()
                ->with('error', 'Transaksi sudah dikembalikan.');
        }

        DB::beginTransaction();

        try {
            $tanggalDikembalikan = Carbon::today();
            $batasKembali = Carbon::parse($transaksi->tanggal_kembali);

            // 🔧 UBAH NOMINAL DENDA DI SINI
            $dendaPerHari = 100000;
            $denda = 0;

            if ($tanggalDikembalikan->gt($batasKembali)) {
                $hariTerlambat = $batasKembali->diffInDays($tanggalDikembalikan);
                $denda = $hariTerlambat * $dendaPerHari;
            }

            $transaksi->update([
                'tanggal_dikembalikan' => $tanggalDikembalikan,
                'status' => 'dikembalikan',
                'denda' => $denda
            ]);

            foreach ($transaksi->detail as $detail) {
                $detail->buku->increment('stok');
            }

            DB::commit();

            return redirect()->route('transaksi.index')
                ->with('success', 'Buku berhasil dikembalikan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::with('detail.buku')->findOrFail($id);

        DB::beginTransaction();

        try {
            foreach ($transaksi->detail as $detail) {
                $detail->buku->increment('stok');
            }

            $transaksi->detail()->delete();
            $transaksi->delete();

            DB::commit();

            return redirect()->route('transaksi.index')
                ->with('success', 'Transaksi berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}