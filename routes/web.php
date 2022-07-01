<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Listsoal;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Soal\Tmbhsoalessai;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Livewire\Soal\ListSoal as SoalListSoal;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.siswa.auth.login');
})->name('login.siswa');
Route::post('proses_login_siswa', [ AuthController::class, 'Proses_login_siswa'])->name('login.proses_login_siswa');

// siswa area
Route::group(['middleware' => ['auth.siswa']],function(){
    Route::get('listUjian', function(){
        echo Auth::guard('siswa')->user()->nisn;
    })->name('siswa.dashboard');
});


// login guru dan admin
Route::get('/login', function(){
    $u = Auth::user();
    if ($u != null) {
        if ($u->level == 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($u->level == 'guru') {
            return redirect()->route('guru.dashboard');
        }
    }
    return view('pages.admin.auth.login');
})->name('login');
Route::post('proses_login', [ AuthController::class, 'Proses_login'])->name('login.proses_login');
Route::post('logout', [ AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin','as'=>'admin.'], function(){
    // Route admin
    Route::group(['middleware'=> ['auth.admin']], function(){
        Route::view("dashboard","pages.admin.dashboard")->name("dashboard");

        // Route kelas
        Route::view("data_kelas",'pages.admin.kelas.index')->name("data_kelas");

        // Route data users
        Route::group(['prefix'=> 'data_user'], function(){
            Route::view("/",'pages.admin.users.index')->name("data_user");
            Route::view("/tambah_user",'pages.admin.users.tambah')->name("data_user.tambah");
            Route::view("/{userId}/ubah_user",'pages.admin.users.ubah')->name("data_user.update");
        });

         // Route data bank soal
         Route::group(['prefix'=> 'bank_soal'], function(){
            Route::view("/",'pages.admin.banksoal.index')->name("banksoal");
            Route::get("/{soalId}/listsoal", [ Listsoal::class, 'index' ])->name("listsoal");
            Route::view("/{soalId}/tmbhsoalessai",'pages.admin.banksoal.soal.tmbhsoalessai')->name("soaltambah.essai");
            Route::view("/{mapelId}/editsoalessai/{soalId}",'pages.admin.banksoal.soal.updatesoalessai')->name("soaledit.essai");
            Route::view("/{mapelId}/showsoalessai/{soalId}",'pages.admin.banksoal.soal.showsoalessai')->name("soalshow.essai");
            // Route::get('/{soalId}/tmbhsoalessai', Tmbhsoalessai::class)->name('soaltambah.essai');
        });

        // Route data users
        Route::group(['prefix'=> 'data_siswa'], function(){
            Route::view("/",'pages.admin.siswa.index')->name("data_siswa");
            // Route::view("/tambah_user",'pages.admin.users.tambah')->name("data_user.tambah");
            // Route::view("/{userId}/ubah_user",'pages.admin.users.ubah')->name("data_user.update");
        });

         // Route data users
         Route::group(['prefix'=> 'ujian','as'=>'ujian.'], function(){
            Route::view("/",'pages.admin.ujian.index')->name("index");
            // Route::view("/tambah_user",'pages.admin.users.tambah')->name("data_user.tambah");
            // Route::view("/{userId}/ubah_user",'pages.admin.users.ubah')->name("data_user.update");
        });
    });


});

Route::group(['prefix' => 'guru','as'=>'guru.'], function(){

    // Route guru
    Route::group(['middleware'=> ['auth.guru']], function(){
        Route::view("dashboard","pages.admin.dashboard")->name("dashboard");

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

        });

         // Route data users
         Route::group(['prefix'=> 'ujian','as'=>'ujian.'], function(){
            Route::view("/",'pages.admin.ujian.index')->name("index");
            Route::view("/tmbhujian",'pages.admin.ujian.tambahujian')->name("tambah");
            Route::view("/{ujianId}/ubahujian",'pages.admin.ujian.ubahujian')->name("ubah");

            // Route::view("/tambah_user",'pages.admin.users.tambah')->name("data_user.tambah");
            // Route::view("/{userId}/ubah_user",'pages.admin.users.ubah')->name("data_user.update");
        });
    });


});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
