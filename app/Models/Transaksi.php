<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // Menegaskan nama tabel
    protected $primaryKey = 'id_transaksi'; 
    public $incrementing = true;

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
        // Pastikan foreign key di tabel transaksis adalah anggota_id
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function detail()
    {
        // Relasi ke detail transaksi menggunakan id_transaksi sebagai penghubung
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}