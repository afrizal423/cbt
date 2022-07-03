<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->foreign(['siswa_id'], 'fk_nilais_hasil_sis_siswas')->references(['id'])->on('siswas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign(['ujian_id'], 'fk_nilais_nilai_uji_ujians')->references(['id'])->on('ujians')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign('fk_nilais_hasil_sis_siswas');
            $table->dropForeign('fk_nilais_nilai_uji_ujians');
        });
    }
}
