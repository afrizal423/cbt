<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ujians', function (Blueprint $table) {
            $table->foreign(['guru_id'], 'fk_ujians_membuat_gurus')->references(['id'])->on('gurus')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign(['kelas_id'], 'fk_ujians_memiliki_kelas')->references(['id'])->on('kelas')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign(['mapel_id'], 'fk_ujians_memiliki__mapels')->references(['id'])->on('mapels')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ujians', function (Blueprint $table) {
            $table->dropForeign('fk_ujians_membuat_gurus');
            $table->dropForeign('fk_ujians_memiliki_kelas');
            $table->dropForeign('fk_ujians_memiliki__mapels');
        });
    }
}
