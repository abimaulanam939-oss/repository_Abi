<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Menghubungkan ke tabel 'peminjaman'
    protected $table = 'peminjaman';

    // Primary Key sesuai database
    protected $primaryKey = 'id_transaksi';

    protected $guarded = [];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id');
    }

  public function detail()
{
    // Ganti DetailTransaksi menjadi DetailPeminjaman
    return $this->hasMany(DetailPeminjaman::class, 'id_transaksi', 'id_transaksi');
}
}