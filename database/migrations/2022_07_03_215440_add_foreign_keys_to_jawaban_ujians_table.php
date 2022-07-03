<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJawabanUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jawaban_ujians', function (Blueprint $table) {
            $table->foreign(['ujian_id'], 'fk_jawaban__jawaban_d_ujians')->references(['id'])->on('ujians')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign(['siswa_id'], 'fk_jawaban__jawaban_s_siswas')->references(['id'])->on('siswas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign(['soal_id'], 'fk_jawaban__memiliki__soals')->references(['id'])->on('soals')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jawaban_ujians', function (Blueprint $table) {
            $table->dropForeign('fk_jawaban__jawaban_d_ujians');
            $table->dropForeign('fk_jawaban__jawaban_s_siswas');
            $table->dropForeign('fk_jawaban__memiliki__soals');
        });
    }
}
