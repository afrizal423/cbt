<?php

namespace App\Jobs;

use App\Models\Nilai;
use App\Models\Ujian;
use App\Models\IkutUjian;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ketikaWaktuUjianHabis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $u = Ujian::with(['nilais'])->where('status_penilaian_ujian', false)->get();

        foreach ($u as $key => $ujn) {
            $sekarang = Carbon::now();
            $mulai = Carbon::parse($ujn->tgl_selesai_ujian.' '.$ujn->waktu_selesai_ujian);
            $waktuMulaiUjian = $sekarang->gt($mulai);
            $nilai = Nilai::where('ujian_id', $ujn->id)->get();
            foreach ($nilai as $key => $value) {
                if ($value->status_penilaian == null && $waktuMulaiUjian) {
                    Nilai::where('ujian_id', $ujn->id)
                        ->where('siswa_id', $value->siswa_id)
                        ->update([
                            'nilai_ujian' => 0,
                            'status_penilaian' => false
                        ]);
                    IkutUjian::updateOrCreate([
                        'siswa_id' => $value->siswa_id,
                        'ujian_id' => $ujn->id
                    ],[
                        'sudah_ujian' => true
                    ]);
                }
            }
        }
    }
}
