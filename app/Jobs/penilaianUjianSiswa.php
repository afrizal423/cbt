<?php

namespace App\Jobs;

use Afrizalmy\TextSearch\TfIdfJaccard;
use App\Models\JawabanUjian;
use App\Models\ListJawabansoal;
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

    public function findNilaiMax(array $dataAsli, array $hasilPerhitungan, int $bobot_nilai): array
    {
        $maxValue = max($hasilPerhitungan);
        $maxIndex = array_search($maxValue, $hasilPerhitungan);
        $jawabanNya = $dataAsli[$maxIndex];
        $hasil = [
            "nilai" => floatval($maxValue->similarity) * $bobot_nilai,
            "index" => $maxIndex,
            "text_jawaban" => $jawabanNya
        ];

        return $hasil;
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
                            'bobot_nilai' => 0
                        ]
                    );
                    //echo PHP_EOL.'SALAH ';
                }


            } elseif ($value['type_soal'] == 'essai') {
                echo PHP_EOL.json_decode($j['jawaban_siswa']).' '.PHP_EOL;
                PHP_EOL;
                $lj = ListJawabansoal::select('text_jawaban')
                                ->where('soal_id', $value['id'])
                                ->first()
                                ->toArray();
                $listjawaban = json_decode($lj['text_jawaban']);
                array_push($listjawaban, $value['kunci']);
                var_dump($listjawaban);
                PHP_EOL;
                $tfidfjaccard = new TfIdfJaccard();
                $tfidfjaccard->document($listjawaban)
                                    ->query($j['jawaban_siswa'])
                                    ->HitungTFIDF();
                $hasilakhir = $tfidfjaccard->HitungJaccard();
                echo json_encode($hasilakhir).PHP_EOL;
                PHP_EOL;
                echo "didapatkan".PHP_EOL;
                var_dump($this->findNilaiMax($listjawaban, $hasilakhir, $value['bobot_soal']));
                PHP_EOL;
                PHP_EOL;
                PHP_EOL;
            }
        }
    }
}
