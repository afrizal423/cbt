<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkutUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikut_ujians', function (Blueprint $table) {
            $table->char('id', 26)->primary()->unique('ikut_ujian_pk');
            $table->char('siswa_id', 26)->nullable()->index('siswa_ikut_ujian_fk');
            $table->char('ujian_id', 26)->nullable()->index('status_ujian_siswa_fk');
            // status buat mengetahui kehadiran
            $table->boolean('status')->default(true)->nullable();
            // sudah_ujian buat mengetahui kalu sudha pernah mengerjakan dan menekan tombol selesai
            $table->boolean('sudah_ujian')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ikut_ujians');
    }
}
