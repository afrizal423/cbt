<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Soal;
use Illuminate\Http\Request;

class Listsoal extends Controller
{
    public function index($id)
    {
        $data = [
            "jumlah_soalpilgan" => Soal::where('type_soal', 'pilgan')->count(),
            "jumlah_essai" => Soal::where('type_soal', 'essai')->count(),
            "identitas_soal" => Mapel::where('id',$id)->first()
        ];
        // dd($data);
        return view('pages.admin.banksoal.listsoal', $data);
    }
}
