<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->char('id', 26)->unique('soal_pk');
            $table->char('mapel_id', 26)->nullable()->index('memiliki_soal_fk');
            $table->smallInteger('no_soal')->nullable();
            $table->text('soal')->nullable();
            $table->json('opsi_jawaban')->nullable();
            $table->text('kunci')->nullable();
            $table->string('media_soal', 1)->nullable();
            $table->string('type_soal', 100)->nullable();
            $table->float('bobot_soal', 0, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soals');
    }
}
