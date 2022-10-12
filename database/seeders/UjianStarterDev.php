<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UjianStarterDev extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UjiansTableSeeder::class);
        $this->call(IkutUjiansTableSeeder::class);
        $this->call(JawabanUjiansTableSeeder::class);
    }
}
