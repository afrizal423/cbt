<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    private $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public function random_strings($length_of_string) {
        return substr(sha1(time()), 0, $length_of_string);
    }

    public function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        //aku
        $siszal = new \App\Models\Siswa;
        $siszal->nisn = 123;
        $siszal->nama_siswa = 'rizal';
        $siszal->tgl_lahir_siswa = $faker->dateTimeBetween('2016-01-01', '2017-12-31');
        $siszal->alamat_siswa = $faker->address();
        $siszal->password = 123;
        $siszal->save();

        // dummy
        for ($i=0; $i < 10; $i++) {
            $siswa = new \App\Models\Siswa;
            $siswa->nisn = $this->generate_string($this->permitted_chars, 10);
            $siswa->nama_siswa = $faker->name();
            $siswa->tgl_lahir_siswa = $faker->dateTimeBetween('2016-01-01', '2017-12-31');
            $siswa->alamat_siswa = $faker->address();
            $siswa->password = "siswa";
            $siswa->save();
        }
    }
}
