<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

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
            return redirect()->route('nyoba');
        }
        return view('pages.admin.auth.login');
    })->name('login');
    Route::post('proses_login', [ AuthController::class, 'Proses_login'])->name('login.proses_login');
    // Route::get('/login', [ LoginController::class, "index" ])->name('login');
});
