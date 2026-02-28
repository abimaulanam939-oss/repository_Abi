<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAnggotasTable extends Migration
{
    public function up()
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropColumn(['email', 'no_hp', 'alamat']);
            $table->string('kelas');
            $table->string('jurusan');
        });
    }

    public function down()
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->string('email');
            $table->string('no_hp');
            $table->text('alamat');
            $table->dropColumn(['kelas', 'jurusan']);
        });
    }
}