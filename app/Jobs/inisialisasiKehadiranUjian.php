<?php

namespace App\Jobs;

use App\Models\Soal;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Ujian;
use App\Models\IkutUjian;
use App\Models\JawabanUjian;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class inisialisasiKehadiranUjian implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $datanya;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->datanya = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $u = Ujian::with('mapel')
                ->where('id', $this->datanya['ujian_id'])
                ->first();
        $s = Soal::select('id')
            ->where('mapel_id', $u->mapel->id)
            ->get();
        $siswa = Siswa::where('kelas_id', $this->datanya['kelas_id'])->get();
        foreach ($siswa as $key => $value) {
            // proses insert data ikutujians
            IkutUjian::updateOrCreate([
                'siswa_id' => $value->id,
                'ujian_id' => $this->datanya['ujian_id']
            ],[
                'status' => false
            ]);

            // inisialisasi nilai
            // jika data baru
            if ($this->datanya['status'] == 'baru') {
                // inisialisasi jawabanujian
                foreach ($s as $key => $soal) {
                    JawabanUjian::updateOrCreate([
                        'soal_id' => $soal->id,
                        'siswa_id' => $value->id,
                        'ujian_id' => $this->datanya['ujian_id']
                    ],
                    [
                        'jawaban_siswa' => null,
                        'ragu_jawaban' => false
                    ]);
                }
                Nilai::updateOrCreate([
                    'siswa_id' => $value->id,
                    'ujian_id' => $this->datanya['ujian_id']
                ],[
                    'nilai_ujian' => 0,
                    'status_penilaian' => null
                ]);
            } elseif ($this->datanya['status'] == 'ubah') {
                // jika data lama, tidak mengubah apa2
                $n = Nilai::where('siswa_id', $value->id)
                            ->where('ujian_id', $this->datanya['ujian_id'])
                            ->first();

                Nilai::updateOrCreate([
                    'siswa_id' => $value->id,
                    'ujian_id' => $this->datanya['ujian_id']
                ],[
                    'nilai_ujian' => $n->nilai_ujian,
                    'status_penilaian' => $n->status_penilaian
                ]);
            }

        }
    }
}
