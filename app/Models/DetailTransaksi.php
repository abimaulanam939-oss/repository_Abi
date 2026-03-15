<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksis';

  protected $fillable = [
    'transaksi_id',
    'buku_id',
    'kondisi'
];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}