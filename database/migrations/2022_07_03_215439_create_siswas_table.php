<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->char('id', 26)->primary()->unique('siswa_pk');
            $table->string('nisn', 100)->nullable();
            $table->string('nama_siswa', 100)->nullable();
            $table->date('tgl_lahir_siswa')->nullable();
            $table->string('alamat_siswa', 200)->nullable();
            $table->string('password', 100)->nullable();
            $table->char('kelas_id', 26)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
