<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class hapusUjian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:hapusUjian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'HATI HATI!!!!!!!!!!.Menghapus semua Ujian.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \DB::table('jawaban_ujians')->delete();
        \DB::table('ikut_ujians')->delete();
        \DB::table('ujians')->delete();
        return Command::SUCCESS;
    }
}
