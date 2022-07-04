<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $admin = new \App\Models\User;
        $admin->email= "me@afrizalmy.com";
        $admin->username= "admin";
        $admin->password= Hash::make("admin");
        $admin->level = "admin";
        $admin->save();

        $guru = new \App\Models\Guru;
        $guru->nama_guru = "Ini admin";
        $guru->alamat_guru = $faker->address();
        $guru->jabatan_guru = "ini admin";
        $guru->notelp_guru = $faker->phoneNumber();
        $guru->foto_guru = "soon";
        $admin->guru()->save($guru);

        $adminguru = new \App\Models\User;
        $adminguru->email= "guru@afrizalmy.com";
        $adminguru->username= "guru";
        $adminguru->password= Hash::make("guru");
        $adminguru->level = "guru";
        $adminguru->save();

        $guru2 = new \App\Models\Guru;
        $guru2->nama_guru = "Ini Guru";
        $guru2->alamat_guru = $faker->address();
        $guru2->jabatan_guru = "guru tetap";
        $guru2->notelp_guru = $faker->phoneNumber();
        $guru2->foto_guru = "soon";
        $admin->guru()->save($guru2);
    }
}
