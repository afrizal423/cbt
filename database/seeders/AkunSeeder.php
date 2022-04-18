<?php

namespace Database\Seeders;

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
        $admin = new \App\Models\User;
        $admin->email= "me@afrizalmy.com";
        $admin->username= "afrizal";
        $admin->password= Hash::make("afrizal");
        $admin->level = "admin";
        $admin->save();
    }
}
