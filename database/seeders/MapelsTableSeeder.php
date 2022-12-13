<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MapelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mapels')->delete();
        
        \DB::table('mapels')->insert(array (
            0 => 
            array (
                'id' => '01g732g64qmcd0vs0x3x1aedrz',
                'kode_mapel' => 'BHSINDOKLS6A',
                'nama_mapel' => 'Bahasa Indonesia Kelas 6',
                'kkm_mapel' => '60',
                'jumlah_opsi_jawaban' => 4,
                'jumlah_pilihan_ganda' => 5,
                'jumlah_essai' => 5,
                'status_mapel' => NULL,
            ),
            1 => 
            array (
                'id' => '01gkv0cavf1hhcyd8s0hg1552d',
                'kode_mapel' => 'PPKN6',
                'nama_mapel' => 'UH PPKN Kelas 6',
                'kkm_mapel' => '70',
                'jumlah_opsi_jawaban' => 0,
                'jumlah_pilihan_ganda' => 0,
                'jumlah_essai' => 15,
                'status_mapel' => true,
            ),
        ));
        
        
    }
}