<?php

namespace Database\Seeders;

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
        

        \DB::table('ikut_ujians')->delete();
        
        \DB::table('ikut_ujians')->insert(array (
            0 => 
            array (
                'id' => '01ge17tvy7xq2dv1jr5ercxr34',
                'siswa_id' => '01ge17pg494yx1s29qycjsjvxp',
                'ujian_id' => '01ge17rk63nfzk87z1sd4fm5xd',
                'status' => true,
                'sudah_ujian' => false,
            ),
        ));
        
        
    }
}