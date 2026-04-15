<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman'; // Nama tabel di database
    protected $primaryKey = 'id_detail';    // Primary key sesuai SQL Anda

    protected $fillable = [
        'id_transaksi',
        'buku_id',
        'kondisi',
        'no_seri'
    ];

    // Relasi ke tabel peminjaman utama
    public function transaksi()
    {
        return $this->belongsTo(Peminjaman::class, 'id_transaksi', 'id_transaksi');
    }

    // Relasi ke tabel buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'buku_id');
    }
}