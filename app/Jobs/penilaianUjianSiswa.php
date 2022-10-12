<?php

namespace App\Jobs;

use App\Models\JawabanUjian;
use App\Models\Ujian;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class penilaianUjianSiswa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $siswa;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->siswa = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // delay biar ada jeda
        // sleep(5);
        $u = Ujian::select('mapel_id')->with([
            'mapel' => function($q){
                $q->select('id');
                $q->with(
                    [
                        'soals' => function($q){
                            $q->select('id', 'mapel_id','type_soal','kunci','bobot_soal');
                        }
                    ]
                );
            }
        ])->where('id', $this->siswa['ujian_id'])->first()->toArray();
        foreach ($u['mapel']['soals'] as $key => $value) {
            $j = JawabanUjian::where('soal_id', $value['id'])
                    ->where('siswa_id', $this->siswa['siswa_id'])
                    ->where('ujian_id', $this->siswa['ujian_id'])
                    ->first()->toArray();
            if ($value['type_soal'] == 'pilgan') {
                if (json_decode($j['jawaban_siswa']) == $value['kunci']) {
                    JawabanUjian::updateOrCreate(
                        [
                            'siswa_id' => $this->siswa['siswa_id'],
                            'ujian_id' => $this->siswa['ujian_id'],
                            'soal_id' => $value['id']
                        ],
                        [
                            'rekomendasi_bobot_nilai' => $value['bobot_soal'],
                            'bobot_nilai' => $value['bobot_soal']
                        ]
                    );

                    //echo PHP_EOL.' bener';
                } else {
                    JawabanUjian::updateOrCreate(
                        [
                            'siswa_id' => $this->siswa['siswa_id'],
                            'ujian_id' => $this->siswa['ujian_id'],
                            'soal_id' => $value['id']
                        ],
                        [
                            'rekomendasi_bobot_nilai' => null,
                            'bobot_nilai' => null
                        ]
                    );
                    //echo PHP_EOL.'SALAH ';
                }


            } elseif ($value['type_soal'] == 'essai') {
                // echo json_decode($j['jawaban_siswa']).' ini esai'.PHP_EOL;
            }
        }
    }
}
