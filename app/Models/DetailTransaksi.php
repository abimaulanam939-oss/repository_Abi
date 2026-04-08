<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksis';
    protected $primaryKey = 'id_detail'; // Sesuai file SQL kamu

    protected $fillable = [
        'id_transaksi',
        'buku_id',
        'kondisi',
        'no_seri'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function buku()
    {
        // Relasi ke model Buku menggunakan buku_id
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}