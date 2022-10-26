<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
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

    public function listsoal($ujian_id, Request $request)
    {
        $u = Ujian::where('id', $ujian_id)->with([
            'mapel' => function ($q) {
                $q->select("id", "nama_mapel", "kkm_mapel");
            }
        ])->first();

        $s = Siswa::where('id', $request['siswaId'])->first();
        return view('pages.guru.ujian.listsoalpenilaianujian', [
            'ujian' => $u,
            'siswa' => $s
        ]);
    }

    public function nilaisoal($ujian_id, Request $request)
    {
        $u = Ujian::where('id', $ujian_id)->with([
            'mapel' => function ($q) use ($request) {
                $q->select("id", "nama_mapel", "kkm_mapel");
                $q->with([
                    'soals' => function ($q2) use ($request){
                        $q2->select('mapel_id', 'type_soal');
                        $q2->where('id', $request['soalId']);
                        $q2->first();
                    }
                ]);
            }
        ])->first();

        // dd($u->toArray());

        $s = Siswa::where('id', $request['siswaId'])->first();
        return view('pages.guru.ujian.penilaiansoalujian', [
            'ujian' => $u,
            'siswa' => $s,
            'soalId' => $request['soalId']
        ]);
    }
}
