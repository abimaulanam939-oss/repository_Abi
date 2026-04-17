<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'm_bukus';

    // WAJIB: Beritahu Laravel bahwa primary key-nya bukan 'id'
    protected $primaryKey = 'buku_id';

    protected $fillable = [
        'judul', 
        'no_seri', 
        'pengarang', 
        'penerbit', 
        'tahun_terbit', 
        'jumlah_halaman'
    ];
}