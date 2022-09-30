<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Ujian;
use Livewire\Component;
use App\Models\SoalnyaSiswaUjian;
use Illuminate\Support\Facades\Auth;

class UjianPlayground extends Component
{
    public $ujian_id, $nomor_soal, $soal, $listsoal;

    public function mount(){

        $this->soal = Ujian::select('mapel_id')->with([
            'mapel' => function($q){
                $q->select('id');
                $q->with(
                    [
                        'soals' => function($q){
                            $siswa = Auth::guard('siswa')->user();
                            $ambilIdSoal = SoalnyaSiswaUjian::where('siswa_id', $siswa->id)
                                    ->where('ujian_id', $this->ujian_id)->first();
                            $this->listsoal = json_decode($ambilIdSoal->listsoal);
                            $q->select('id', 'mapel_id', 'soal', 'type_soal', 'bobot_soal');
                            $q->where('id', $this->listsoal[$this->nomor_soal-1]);
                            $q->first();
                        }
                    ]
                );
            }
        ])->where('id',$this->ujian_id)->first();

        // dd($u->toJson());

    }
    public function render()
    {
        return view('livewire.siswa.ujian-playground');
    }
}
