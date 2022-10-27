<?php

namespace App\Jobs;

use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\IkutUjian;
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
        $siswa = Siswa::where('kelas_id', $this->datanya['kelas_id'])->get();
        foreach ($siswa as $key => $value) {
            // proses insert data ikutujians
            IkutUjian::updateOrCreate([
                'siswa_id' => $value->id,
                'ujian_id' => $this->datanya['ujian_id']
            ],[
                'status' => false
            ]);

            // inisialisasi nilai 0
            Nilai::updateOrCreate([
                'siswa_id' => $value->id,
                'ujian_id' => $this->datanya['ujian_id']
            ]);
        }
    }
}
