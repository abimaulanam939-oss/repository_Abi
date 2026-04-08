<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'm_bukus';
    protected $primaryKey = 'buku_id'; // WAJIB
    public $incrementing = true;

    protected $fillable = [
        'judul',
        'no_seri',
    ];
}