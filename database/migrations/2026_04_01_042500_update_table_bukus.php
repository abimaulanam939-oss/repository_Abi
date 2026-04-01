<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bukus', function (Blueprint $table) {

            // tambah kolom no seri
            $table->string('no_seri')->after('judul');

            // hapus semua kolom selain judul
            $table->dropColumn([
                'penulis',
                'penerbit',
                'tahun',
                'stok'
            ]);
        });
    }

    public function down()
    {
        Schema::table('bukus', function (Blueprint $table) {

            $table->string('penulis')->nullable();
            $table->string('penerbit')->nullable();
            $table->integer('tahun')->nullable();
            $table->integer('stok')->nullable();

            $table->dropColumn('no_seri');
        });
    }
};