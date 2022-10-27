<?php

use App\Models\Ujian;
use App\Models\IkutUjian;
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
        $stts = Ujian::with(['guru', 'mapel', 'mapel.soals'])->where('id',$ujian_id)->first();
        $sekarang = Carbon::now();
        $mulai = Carbon::parse($stts->tgl_mulai_ujian.' '.$stts->waktu_mulai_ujian);
        $waktuMulaiUjian = $sekarang->gte($mulai);
        $mulaiUjian = Carbon::parse($stts->tgl_mulai_ujian.' '.$stts->waktu_mulai_ujian);
        $akhirUjian = Carbon::parse($stts->tgl_selesai_ujian.' '.$stts->waktu_selesai_ujian);
        $batasWaktuIkut = $mulaiUjian->addMinutes($stts->keterlambatan_ujian);
        $siswa = Auth::guard('siswa')->user();
        // $cekSudahUjian = IkutUjian::where('siswa_id', $siswa->id)->where('ujian_id', $ujian_id)->where('sudah_ujian', false)->count();
        // dd($cekSudahUjian);

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
            IkutUjian::updateOrCreate([
                'siswa_id' => $siswa->id,
                'ujian_id' => $ujian_id
            ]);

            // inisialisasi nilai null
            Nilai::updateOrCreate([
                'siswa_id' => $siswa->id,
                'ujian_id' => $ujian_id
            ]);

            // proses insert pengacakan soal
            $u = Ujian::select('mapel_id')->with([
                'mapel' => function($q){
                    $q->select('id');
                    $q->with(
                        [
                            'soals' => function($q){
                                $q->inRandomOrder();// jika random. klo gak hapus aja
                                $q->select('id', 'mapel_id');
                            }
                        ]
                    );
                }
            ])->where('id', $ujian_id)->first()->toArray();
            $data = [];
            foreach ($u['mapel']['soals'] as $key => $value) {
                array_push($data, $value['id']);
            }
            // echo '<pre>' . var_export($data, true) . '</pre>';
            // echo json_encode($data);
            SoalnyaSiswaUjian::updateOrCreate([
                'siswa_id' => $siswa->id,
                'ujian_id' => $ujian_id],
                ['listsoal' => json_encode($data)]
            );

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

