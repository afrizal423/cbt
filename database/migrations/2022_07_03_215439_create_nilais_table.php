<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->char('ujian_id', 26)->nullable()->index('nilai_ujian_siswa_fk');
            $table->char('siswa_id', 26)->nullable()->index('hasil_siswa_fk');
            $table->float('nilai_ujian', 0, 0)->nullable();
            $table->boolean('status_penilaian')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}
