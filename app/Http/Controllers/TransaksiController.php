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

    public function index()
    {
        $transaksis = Transaksi::with('anggota','detail.buku')->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        $bukus = Buku::all();

        return view('transaksi.create', compact('anggotas','bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'=>'required',
            'buku_id'=>'required'
        ]);

        DB::beginTransaction();

        try{

            $tanggalPinjam = Carbon::now();

            // BATAS PENGEMBALIAN 3 HARI
            $tanggalKembali = Carbon::now()->addDays(3);

            $transaksi = Transaksi::create([
                'anggota_id'=>$request->anggota_id,
                'tanggal_pinjam'=>$tanggalPinjam,
                'tanggal_kembali'=>$tanggalKembali,
                'status'=>'dipinjam',
                'denda'=>0
            ]);

            $bukuIds = (array) $request->buku_id;

            foreach($bukuIds as $buku){

                DetailTransaksi::create([
                    'transaksi_id'=>$transaksi->id,
                    'buku_id'=>$buku
                ]);

                Buku::where('id',$buku)->decrement('stok');
            }

            DB::commit();

            return redirect()->route('transaksi.index');

        }catch(\Exception $e){

            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    // KEMBALIKAN BUKU
    public function kembalikan($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $hariIni = Carbon::now();
        $batas = Carbon::parse($transaksi->tanggal_kembali);

        $denda = 0;

        // HITUNG TELAT
        if($hariIni->gt($batas)){

            $telat = $hariIni->diffInDays($batas);

            $denda = $telat * 1000; // 1000 per hari
        }

        $transaksi->update([
            'tanggal_dikembalikan'=>$hariIni,
            'status'=>'dikembalikan',
            'denda'=>$transaksi->denda + $denda
        ]);

        $details = DetailTransaksi::where('transaksi_id',$id)->get();

        foreach($details as $d){
            Buku::where('id',$d->buku_id)->increment('stok');
        }

        return redirect()->route('transaksi.index');
    }

    // BUKU HILANG
    public function hilang($id)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id);

        $jumlahBuku = $transaksi->detail->count();

        $denda = $jumlahBuku * 50000;

        $transaksi->update([
            'status'=>'hilang',
            'denda'=>$denda
        ]);

        return redirect()->route('transaksi.index');
    }

    // BUKU RUSAK
    public function rusak($id)
    {
        $transaksi = Transaksi::with('detail')->findOrFail($id);

        $jumlahBuku = $transaksi->detail->count();

        $denda = $jumlahBuku * 30000;

        $transaksi->update([
            'status'=>'rusak',
            'denda'=>$denda
        ]);

        return redirect()->route('transaksi.index');
    }

    public function destroy($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $transaksi->delete();

    return redirect()->route('transaksi.index')
    ->with('success','Data berhasil dihapus');
}
}