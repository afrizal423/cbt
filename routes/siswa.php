<?php

use App\Jobs\SiswaIkutUjian;
use App\Models\Ujian;
use App\Models\IkutUjian;
use App\Models\Mapel;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\SoalnyaSiswaUjian;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// siswa area
Route::group(['middleware' => ['auth.siswa']],function(){
    Route::get('listUjian', function(){
        return view('pages.siswa.landing.index');
    })->name('siswa.dashboard');

    Route::get('ikutUjian/{ujian_id}', function($ujian_id){
        // $siswa = Auth::guard('siswa')->user();
        $stts = Ujian::with(['guru', 'mapel'])->where('id',$ujian_id)->first()->toArray();
        // dd(IkutUjian::where('siswa_id', $siswa->id)->where('ujian_id', $ujian_id)->where('status', true)->first());


        if ($stts['status_ujian'] == false) {
            return redirect()->route('siswa.dashboard');
        }
        return view('pages.siswa.landing.ikut-ujian');
    })->name('siswa.ikutujian');

    Route::post('joinExam/{ujian_id}', function(Request $request, $ujian_id){
        $stts = Ujian::select('mapel_id','tgl_mulai_ujian', 'waktu_mulai_ujian', 'tgl_selesai_ujian', 'waktu_selesai_ujian', 'code_ujian')->where('id',$ujian_id)->first();
        $sekarang = Carbon::now();
        $mulai = Carbon::parse($stts->tgl_mulai_ujian.' '.$stts->waktu_mulai_ujian);
        $waktuMulaiUjian = $sekarang->gte($mulai);
        $mulaiUjian = Carbon::parse($stts->tgl_mulai_ujian.' '.$stts->waktu_mulai_ujian);
        $akhirUjian = Carbon::parse($stts->tgl_selesai_ujian.' '.$stts->waktu_selesai_ujian);
        $batasWaktuIkut = $mulaiUjian->addMinutes($stts->keterlambatan_ujian);
        $siswa = Auth::guard('siswa')->user();
        $cekSudahUjian = IkutUjian::where('siswa_id', $siswa->id)->where('ujian_id', $ujian_id)->where('sudah_ujian', true)->count();

        // cek sudah ujian
        if ($cekSudahUjian > 0) {
            return redirect()->back()->withErrors(['done' => 'Anda Sudah Menyelesaikan Ujian :)']);
        }
        // cek token
        if ($request->input('token_ujian') == null || $request->input('token_ujian') == '') {
            return redirect()->back()->withErrors(['token' => 'Token Ujian Tidak Boleh Kosong']);
        }
        if ($request->input('token_ujian') != $stts->code_ujian) {
            return redirect()->back()->withErrors(['token' => 'Token Ujian Salah']);
        }

        /**
         * Backup
         *
         * jika token benar dan waktumulaiujian lbh dari atau sama dgn didatabase dan tidak lebih dari keterlambatan
         * if ($request->input('token_ujian') == $stts->code_ujian && $waktuMulaiUjian && $sekarang->lte($batasWaktuIkut)) {
         *
        */

        // jika token benar dan waktu tidak lebih dari batas akhir ujian
        if ($request->input('token_ujian') == $stts->code_ujian && $sekarang->lt($akhirUjian)) {
            // proses insert data ikutujians
            // $dt['siswa_id'] = $siswa->id;
            // $dt['ujian_id'] = $ujian_id;
            // SiswaIkutUjian::dispatch($dt);
            IkutUjian::updateOrCreate([
                'siswa_id' => $siswa->id,
                'ujian_id' => $ujian_id
            ],[
                'status' => true
            ]);

            // inisialisasi nilai 0
            Nilai::updateOrCreate([
                'siswa_id' => $siswa->id,
                'ujian_id' => $ujian_id
            ],[
                'nilai_ujian' => 0,
                'status_penilaian' => false
            ]);

            return redirect()->route('ujian_playground', [
                'ujian_id' => $ujian_id]);
        }

        // return redirect()->back();
    })->name('siswa.joinExam');

    Route::get('exam/{ujian_id}', function($ujian_id){
        $stts = Ujian::with(['guru', 'mapel', 'mapel.soals'])->where('id',$ujian_id)->first();
        $sekarang = Carbon::now();
        $mulai = Carbon::parse($stts->tgl_mulai_ujian.' '.$stts->waktu_mulai_ujian);
        $waktuMulaiUjian = $sekarang->gte($mulai);
        $akhirUjian = Carbon::parse($stts->tgl_selesai_ujian.' '.$stts->waktu_selesai_ujian);
        $siswa = Auth::guard('siswa')->user();
        $cekSoal = SoalnyaSiswaUjian::where('siswa_id', $siswa->id)
                        ->where('ujian_id', $ujian_id)
                        ->count();
        $cekSudahUjian = IkutUjian::where('siswa_id', $siswa->id)->where('ujian_id', $ujian_id)->where('sudah_ujian', true)->count();

        // cek akses ujian
        if (!$stts->status_ujian) {
            return redirect()->route('siswa.ikutujian', [
                'ujian_id' => $ujian_id
            ]);
        }
        // cek sudah ujian
        if ($cekSudahUjian > 0) {
            return redirect()->back()->withErrors(['done' => 'Anda Sudah Menyelesaikan Ujian :)']);
        }

        if ($sekarang->lt($akhirUjian) && $waktuMulaiUjian && $cekSoal == 1) {
            return App::call('App\Http\Controllers\Siswa\UjianPlayground@index', [
                'ujian_id' => $ujian_id
            ]);
        } elseif (!$sekarang->lt($akhirUjian)) {
            return redirect()->route('siswa.ikutujian', [
                'ujian_id' => $ujian_id
            ])->withErrors(['ujian' => 'Waktu ujian telah selesai.']);
        }

        return redirect()->route('siswa.ikutujian', [
            'ujian_id' => $ujian_id
        ])->withErrors(['token' => 'Token Ujian Kosong']);

    })->name('ujian_playground');
});


