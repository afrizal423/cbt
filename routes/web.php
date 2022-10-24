<?php


use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Jobs\penilaianUjianSiswa;

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
    $u = Auth::guard('siswa')->user();
    if ($u != null) {
        return redirect()->route('siswa.dashboard');
    }
    return view('pages.siswa.auth.login');
})->name('login.siswa');
Route::post('proses_login_siswa', [ AuthController::class, 'Proses_login_siswa'])->name('login.proses_login_siswa');
Route::post('siswa-logout', [ AuthController::class, 'logout_siswa'])->name('logout_siswa');

/** ini eksperipen */
Route::get('nilai/{ujian_id}', function ($ujian_id) {
    $siswa = Auth::guard('siswa')->user();
    $dt['siswa_id'] = $siswa->id;
    $dt['ujian_id'] = $ujian_id;
    penilaianUjianSiswa::dispatch($dt);
});
/** hapus jika sudah selesai */


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


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
