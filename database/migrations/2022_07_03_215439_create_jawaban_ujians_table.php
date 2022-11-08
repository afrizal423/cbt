<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban_ujians', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('soal_id', 26)->nullable()->index('memiliki_jawaban_fk');
            $table->char('siswa_id', 26)->nullable()->index('jawaban_siswa_fk');
            $table->char('ujian_id', 26)->nullable()->index('jawaban_dari_ujian_fk');
            $table->longText('jawaban_siswa')->nullable();
            $table->float('bobot_nilai', 0, 0)->nullable();
            $table->boolean('ragu_jawaban')->nullable();
            $table->boolean('selesai_ujian')->nullable();
            $table->float('rekomendasi_bobot_nilai', 0, 0)->nullable();
            $table->json('data_rekomendasi_nilai')->nullable();

            $table->unique(['id'], 'jawaban_ujian_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban_ujians');
    }
}
