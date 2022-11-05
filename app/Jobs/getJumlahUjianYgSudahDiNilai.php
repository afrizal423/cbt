<?php

namespace App\Jobs;

use App\Models\Nilai;
use App\Models\Ujian;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class getJumlahUjianYgSudahDiNilai implements ShouldQueue
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
        $u = Ujian::select('id')->where('status_penilaian_ujian', false)->withCount('ikutUjians')->get();
        // dd($u->toArray());
        foreach ($u as $key => $value) {
            $n = Nilai::where('ujian_id', $value->id)
                    ->where('status_penilaian', true)
                    ->count();
            if ($n == $value->ikut_ujians_count) {
                Ujian::where('id', $value->id)
                        ->update([
                            'status_penilaian_ujian' => true
                        ]);
            }

        }
    }
}
