<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 10; $i++) {
            $userGuru = new \App\Models\User;
            $userGuru->email= $faker->email();
            $userGuru->username= $faker->userName();
            $userGuru->password= Hash::make("guru123");
            $userGuru->level = "guru";
            $userGuru->save();

            $guru = new \App\Models\Guru;
            $guru->nama_guru = $faker->name();
            $guru->alamat_guru = $faker->address();
            $guru->jabatan_guru = "guru tetap";
            $guru->notelp_guru = $faker->phoneNumber();
            $guru->foto_guru = "soon";
            $userGuru->guru()->save($guru);
        }
    }
}
