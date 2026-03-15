<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

public function anggota()
{
    return $this->belongsTo(Anggota::class);
}

public function detail()
{
    return $this->hasMany(DetailTransaksi::class);
}
}
