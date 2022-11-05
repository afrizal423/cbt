<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujians', function (Blueprint $table) {
            $table->char('id', 26)->unique('ujian_pk')->primary();
            $table->char('mapel_id', 26)->nullable()->index('memiliki_mapel_fk');
            $table->char('guru_id', 26)->nullable()->index('membuat_fk');
            $table->char('kelas_id', 26)->nullable()->index('memiliki_fk');
            $table->string('judul', 100)->nullable();
            $table->string('jenis_ujian', 50)->nullable();
            $table->date('tgl_mulai_ujian')->nullable();
            $table->time('waktu_mulai_ujian')->nullable();
            $table->date('tgl_selesai_ujian')->nullable();
            $table->time('waktu_selesai_ujian')->nullable();
            $table->integer('keterlambatan_ujian')->nullable()->default(1);
            $table->string('code_ujian', 20)->nullable();
            $table->boolean('status_ujian')->nullable()->default(false);
            $table->boolean('status_penilaian_ujian')->nullable()->default(false);
            $table->boolean('status_jobs_selesai_ujian')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujians');
    }
}
