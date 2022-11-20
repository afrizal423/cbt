<?php

namespace App\Jobs;

use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\SoalnyaSiswaUjian;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GenerateSoalSiswa implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use Dispatchable;
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
        $siswa = Siswa::where('kelas_id', $this->datanya['kelas_id'])
                ->get();
        foreach ($siswa as $key => $sswa) {
            $uj = Mapel::select('soals.id')
                ->join('soals', 'soals.mapel_id','=','mapels.id')
                ->where('mapels.id', $this->datanya['mapel_id'])
                ->inRandomOrder()
                ->get();
            $data = array_column($uj->toArray(), 'id');

            SoalnyaSiswaUjian::updateOrCreate([
                'siswa_id' => $sswa->id,
                'ujian_id' => $this->datanya['ujian_id']],
                ['listsoal' => json_encode($data)]
            );
        }
    }
}
