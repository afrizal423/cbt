<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StarterDev extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AkunSeeder::class);
        $this->call(MapelsTableSeeder::class);
        $this->call(contohSoal::class);
        $this->call(KelasTableSeeder::class);
        $this->call(SiswaSeeder::class);
    }
}
