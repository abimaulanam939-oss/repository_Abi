<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;
use App\Models\Anggota;

class Transaksi extends Model
{
    protected $fillable = [
        'anggota_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_dikembalikan',
        'denda',
        'status'
    ];

    // 🔥 INI YANG WAJIB DITAMBAHKAN
    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    // Relasi ke anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    // Relasi ke detail transaksi
    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}