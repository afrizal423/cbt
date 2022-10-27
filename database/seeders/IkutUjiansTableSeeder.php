<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Ujian;
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

        $siswa = Siswa::all();
        $ujian = Ujian::all();
        \DB::table('ikut_ujians')->delete();

        foreach ($ujian as $key1 => $u) {
            foreach ($siswa as $key => $sswa) {
                if ($u->kelas_id == $sswa->kelas_id) {
                    \DB::table('ikut_ujians')->insert(array (
                        'id' => '01ge17tvy7xq2dv1jr5ercxr34',
                        'siswa_id' => $sswa->id,
                        'ujian_id' => $ujian->id,
                        'status' => true,
                        'sudah_ujian' => false,
                ));
                }
            }
        }








    }
}
