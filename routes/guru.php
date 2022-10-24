<?php

use App\Http\Controllers\Listsoal;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Soal\Tmbhsoalessai;
use App\Http\Controllers\Admin\DashboardGuru;

Route::group(['prefix' => 'guru','as'=>'guru.'], function(){

    // Route guru
    Route::group(['middleware'=> ['auth.guru']], function(){
        // Route::view("dashboard","pages.admin.dashboard")->name("dashboard");
        Route::get('dashboard', [ DashboardGuru::class, 'index'])->name('dashboard');

        // Route kelas
        Route::view("data_kelas",'pages.admin.kelas.index')->name("data_kelas");

         // Route data bank soal
        Route::group(['prefix'=> 'bank_soal'], function(){
            Route::view("/",'pages.admin.banksoal.index')->name("banksoal");
            Route::get("/{soalId}/listsoal", [ Listsoal::class, 'index' ])->name("listsoal");
            Route::view("/{soalId}/tmbhsoalessai",'pages.admin.banksoal.soal.tmbhsoalessai')->name("soaltambah.essai");
            Route::view("/{mapelId}/editsoalessai/{soalId}",'pages.admin.banksoal.soal.updatesoalessai')->name("soaledit.essai");
            Route::view("/{mapelId}/showsoalessai/{soalId}",'pages.admin.banksoal.soal.showsoalessai')->name("soalshow.essai");
            // Route::get('/{soalId}/tmbhsoalessai', Tmbhsoalessai::class)->name('soaltambah.essai');
            Route::view("/{soalId}/tmbhsoalpilgan",'pages.admin.banksoal.soal.tmbhsoalpilgan')->name("soaltambah.pilgan");
            Route::view("/{mapelId}/editsoalpilgan/{soalId}",'pages.admin.banksoal.soal.updatesoalpilgan')->name("soaledit.pilgan");
            Route::view("/{mapelId}/showsoalpilgan/{soalId}",'pages.admin.banksoal.soal.showsoalpilgan')->name("soalshow.pilgan");


        });

         // Route data ujian
         Route::group(['prefix'=> 'ujian','as'=>'ujian.'], function(){
            Route::view("/",'pages.admin.ujian.index')->name("index");
            Route::view("/tmbhujian",'pages.admin.ujian.tambahujian')->name("tambah");
            Route::view("/{ujianId}/ubahujian",'pages.admin.ujian.ubahujian')->name("ubah");

            Route::group(['prefix'=> 'penilaian','as'=>'penilaian.'], function(){
                Route::view("/",'pages.guru.ujian.indexpenilaianujian')->name("index");
            });
            // Route::view("/tambah_user",'pages.admin.users.tambah')->name("data_user.tambah");
            // Route::view("/{userId}/ubah_user",'pages.admin.users.ubah')->name("data_user.update");
        });
    });


});
