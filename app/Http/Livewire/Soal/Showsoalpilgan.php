<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use App\Models\Mapel;
use Livewire\Component;

class Showsoalpilgan extends Component
{
    public $soalId, $mapelnya, $action, $soal, $jumlahPilihan, $kunciId = [];
    public $idListJawaban= [];

    public function mount(Mapel $mapelId, $soalId)
    {
        $this->soalId = $soalId;
        $this->mapelnya = $mapelId;
        $dt = Soal::with('listJawaban')
            ->where('id',$soalId)
            ->first()
            ->toArray();

        $this->soal['soal'] = $dt['soal'];
        $this->soal['bobot_soal'] = $dt['bobot_soal'];
        $this->kunciId[0] = $dt['kunci'];
        $this->soal['text_jawaban'] = [];
        foreach ($dt['list_jawaban'] as $key => $value) {
            array_push($this->idListJawaban, $value['keyPilgan']);
            array_push($this->soal['text_jawaban'], json_decode($value['text_jawaban']));
        }
        // dd($this->soal);
    }
    public function render()
    {
        return view('livewire.soal.showsoalpilgan');
    }
}
