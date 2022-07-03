<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapels', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->string('kode_mapel', 10)->nullable();
            $table->string('nama_mapel', 200)->nullable();
            $table->float('kkm_mapel', 0, 0)->nullable();
            $table->integer('jumlah_opsi_jawaban')->nullable()->default(5);
            $table->integer('jumlah_pilihan_ganda')->nullable();
            $table->integer('jumlah_essai')->nullable();
            $table->boolean('status_mapel')->nullable();

            $table->unique(['id'], 'mapel_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapels');
    }
}
