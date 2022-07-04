<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KelasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('kelas')->delete();
        
        \DB::table('kelas')->insert(array (
            0 => 
            array (
                'id' => '01g4w9xx1ej4cfj6hawkvkbkg9',
                'kode_kelas' => '6A',
                'nama_kelas' => '6 A',
            ),
            1 => 
            array (
                'id' => '01g4w9y4qqjrdkanc355f33gqy',
                'kode_kelas' => '6B',
                'nama_kelas' => '6 B',
            ),
            2 => 
            array (
                'id' => '01g6qas85p236m57nr72ewcsdg',
                'kode_kelas' => '6C',
                'nama_kelas' => '6 C',
            ),
        ));
        
        
    }
}