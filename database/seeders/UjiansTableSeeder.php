<?php

namespace Database\Seeders;

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
        

        \DB::table('ujians')->delete();
        
        \DB::table('ujians')->insert(array (
            0 => 
            array (
                'id' => '01ge17rk63nfzk87z1sd4fm5xd',
                'mapel_id' => '01g732g64qmcd0vs0x3x1aedrz',
                'guru_id' => '01ge17pg2y7hz5q82gxn8s1jaj',
                'kelas_id' => '01g6qas85p236m57nr72ewcsdg',
                'judul' => 'UH Bahasa Indonesia Kelas 6C',
                'jenis_ujian' => 'UH',
                'tgl_mulai_ujian' => '2022-10-12',
                'waktu_mulai_ujian' => '04:00:00',
                'tgl_selesai_ujian' => '2022-10-12',
                'waktu_selesai_ujian' => '23:59:00',
                'keterlambatan_ujian' => 1,
                'code_ujian' => '123',
                'status_ujian' => true,
            ),
        ));
        
        
    }
}