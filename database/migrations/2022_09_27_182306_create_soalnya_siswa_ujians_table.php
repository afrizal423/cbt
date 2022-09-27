<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soalnya_siswa_ujians', function (Blueprint $table) {
            $table->char('id', 26)->unique();
            $table->char('siswa_id', 26)->nullable();
            $table->char('ujian_id', 26)->nullable();
            $table->json('listsoal')->nullable();
            $table->timestamps();
            $table->foreign('siswa_id')
                        ->references('id')
                        ->on('siswas')
                        ->onDelete('cascade');
            $table->foreign('ujian_id')
                        ->references('id')
                        ->on('ujians')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soalnya_siswa_ujians');
    }
};
