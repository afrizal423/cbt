<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Ujian;
use Illuminate\Http\Request;

class DashboardGuru extends Controller
{
    public function index()
    {
        $ujian = Ujian::all()->count();
        $mapel = Mapel::all()->count();
        $blmdinilai = Ujian::where('status_penilaian_ujian', false)->get()->count();
        $data = [
            "ujian" => $ujian,
            "mapel" => $mapel,
            "blmdinilai" => $blmdinilai
        ];
        // dd($data);
        return view("pages.admin.dashboard-guru", $data);
    }
}
