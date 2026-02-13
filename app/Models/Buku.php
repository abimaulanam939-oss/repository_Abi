<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Nama tabel kalau pakai default Laravel: 'buku'
    // protected $table = 'buku'; // opsional

    // Kolom yang bisa diisi lewat mass assignment
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'stok',
    ];
}
