<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use Illuminate\Http\Request;

class PesertaUjian extends Controller
{
    public function index($ujian_id)
    {
        $u = Ujian::where('id', $ujian_id)->with([
            'mapel' => function ($q) {
                $q->select("id", "nama_mapel", "kkm_mapel");
            }
        ])->first();
        // dd($u->toArray());
        return view('pages.guru.ujian.listpesertaujian', [
            'data' => $u
        ]);
    }
}
