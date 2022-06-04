<?php

namespace App\Http\Controllers;

use App\Models\ListJawabansoal;
use App\Models\Mapel;
use Illuminate\Http\Request;

class Listsoal extends Controller
{
    public function index($id)
    {
        $data = [
            "jumlah_soalpilgan" => ListJawabansoal::where('type_jawaban', 'pilgan')->count(),
            "jumlah_essai" => ListJawabansoal::where('type_jawaban', 'essai')->count(),
            "identitas_soal" => Mapel::find($id)->first()
        ];
        // dd($data);
        return view('pages.admin.banksoal.listsoal', $data);
    }
}
