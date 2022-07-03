<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListJawabansoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_jawabansoals', function (Blueprint $table) {
            $table->char('id', 26)->primary();
            $table->string('type_jawaban', 20)->nullable();
            $table->json('text_jawaban')->nullable();
            $table->char('soal_id', 26)->nullable();
            $table->char('keyPilgan', 26)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_jawabansoals');
    }
}
