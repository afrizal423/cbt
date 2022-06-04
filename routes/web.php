<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Listsoal;

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
    return view('welcome');
})->name('nyoba');


Route::group(['prefix' => 'admin','as'=>'admin.'], function(){
    Route::get('/login', function(){
        if (Auth::user()) {
            return redirect()->route('admin.dashboard');
        }
        return view('pages.admin.auth.login');
    })->name('login');
    Route::post('proses_login', [ AuthController::class, 'Proses_login'])->name('login.proses_login');
    Route::post('logout', [ AuthController::class, 'logout'])->name('logout');

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
        });

    });


});
