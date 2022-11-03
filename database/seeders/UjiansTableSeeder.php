<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kela;
use App\Models\Mapel;
use Rorecek\Ulid\Ulid;
use Illuminate\Database\Seeder;

class UjiansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $mapel = Mapel::first();
        $guru = Guru::where('nama_guru', 'Ini Guru')->first();
        $kelas = Kela::all();

        \DB::table('ujians')->delete();

        foreach ($kelas as $key => $kls) {
            $ulid = new Ulid;
            \DB::table('ujians')->insert(array (
                'id' => $ulid->generate(),
                'mapel_id' => $mapel->id,
                'guru_id' => $guru->id,
                'kelas_id' => $kls->id,
                'judul' => 'UH Bahasa Indonesia Kelas '.$kls->nama_kelas,
                'jenis_ujian' => 'UH',
                'tgl_mulai_ujian' => '2022-10-21',
                'waktu_mulai_ujian' => '04:00:00',
                'tgl_selesai_ujian' => '2022-12-26',
                'waktu_selesai_ujian' => '23:59:00',
                'keterlambatan_ujian' => 1,
                'code_ujian' => '123',
                'status_ujian' => true,
                'status_penilaian_ujian' => false,
        ));
        }




    }
}
