<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kela;
use App\Models\Siswa;

class Dashboard extends Controller
{
    public function index()
    {
        $guru = Guru::all()->count();
        $siswa = Siswa::all()->count();
        $kelas = Kela::all()->count();
        $data = [
            "guru" => $guru,
            "siswa" => $siswa,
            "kelas" => $kelas
        ];
        // dd($data);
        return view("pages.admin.dashboard", $data);

    }
}
