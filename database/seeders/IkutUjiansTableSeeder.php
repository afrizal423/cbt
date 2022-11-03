<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Ujian;
use Rorecek\Ulid\Ulid;
use Illuminate\Database\Seeder;

class IkutUjiansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $ujian = Ujian::all();
        \DB::table('ikut_ujians')->delete();

        foreach ($ujian as $key1 => $u) {
            $siswa = Siswa::where('kelas_id', $u->kelas_id)->get();
            foreach ($siswa as $key => $sswa) {
                $ulid = new Ulid;
                    \DB::table('ikut_ujians')->insert(array (
                        'id' => $ulid->generate(),
                        'siswa_id' => $sswa->id,
                        'ujian_id' => $u->id,
                        'status' => true,
                        'sudah_ujian' => false,
                ));
            }
        }








    }
}
