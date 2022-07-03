<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToIkutUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ikut_ujians', function (Blueprint $table) {
            $table->foreign(['siswa_id'], 'fk_ikut_uji_siswa_iku_siswas')->references(['id'])->on('siswas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign(['ujian_id'], 'fk_ikut_uji_status_uj_ujians')->references(['id'])->on('ujians')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ikut_ujians', function (Blueprint $table) {
            $table->dropForeign('fk_ikut_uji_siswa_iku_siswas');
            $table->dropForeign('fk_ikut_uji_status_uj_ujians');
        });
    }
}
