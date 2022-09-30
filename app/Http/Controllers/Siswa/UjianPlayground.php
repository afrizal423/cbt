<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianPlayground extends Controller
{
    public function index($ujian_id)
    {
        $u = Ujian::with(['mapel'])->where('id', $ujian_id)->first();
        // dd($u);
        return view('pages.siswa.ujian.ujian', [
            'ujian'=>$u
        ]);
    }
}
