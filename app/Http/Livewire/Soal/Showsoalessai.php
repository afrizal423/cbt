<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use App\Models\Mapel;
use Livewire\Component;

class Showsoalessai extends Component
{
    public $mapelnya, $soal, $soalId, $mapelId;
    public $inputs = [];

    public function mount(Mapel $mapelId, $soalId)
    {
        $this->mapelnya = $mapelId;
        $dt = Soal::select(['soal','kunci','bobot_soal','list_jawabansoals.text_jawaban'])
            ->join('list_jawabansoals', 'soals.id','=','list_jawabansoals.soal_id')
            ->find($soalId)->toArray();
        $this->soal['soal'] = $dt['soal'];
        $this->soal['bobot_soal'] = $dt['bobot_soal'];
        $this->soal['kunci'][0] = $dt['kunci'];
        if ($dt['text_jawaban'] != null) {
            $jwbvariasi = json_decode($dt['text_jawaban']);
            foreach ($jwbvariasi as $key => $value) {
                array_push($this->soal['kunci'], $value);
                array_push($this->inputs, $value);
            }
        }

        // dd(Soal::select(['soal','kunci','list_jawabansoals.text_jawaban'])
        //     ->join('list_jawabansoals', 'soals.id','=','list_jawabansoals.soal_id')
        //     ->find($soalId)->toArray());
        // dd($this->soal);
    }

    public function render()
    {
        return view('livewire.soal.showsoalessai');
    }
}
