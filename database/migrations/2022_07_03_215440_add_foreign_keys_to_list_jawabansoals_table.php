<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToListJawabansoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_jawabansoals', function (Blueprint $table) {
            $table->foreign(['soal_id'], 'fk_list_jaw_reference_soals')->references(['id'])->on('soals')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_jawabansoals', function (Blueprint $table) {
            $table->dropForeign('fk_list_jaw_reference_soals');
        });
    }
}
