<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gurus', function (Blueprint $table) {
            $table->char('id', 26)->primary()->unique('guru_pk');
            $table->char('user_id', 26)->nullable()->index('akun_fk');
            $table->string('nama_guru', 100)->nullable();
            $table->string('alamat_guru', 100)->nullable();
            $table->string('jabatan_guru', 100)->nullable();
            $table->string('notelp_guru', 20)->nullable();
            $table->string('foto_guru', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
}
