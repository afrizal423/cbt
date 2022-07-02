<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use App\Models\Mapel;
use Livewire\Component;
use App\Models\ListJawabansoal;

class Updatesoalpilgan extends Component
{
    public $soalId, $mapelnya, $action, $soal, $jumlahPilihan, $kunciId = [];
    public $idListJawaban= [];

    private function resetInputFields()
    {
        $this->soal = '';
        $this->jumlahPilihan = [];
        $this->kunciId = [];
    }

    public function ubah()
    {
        $this->validate([
            'soal.soal' => 'required|min:6',
            'soal.bobot_soal' => 'required|numeric',
            'soal.text_jawaban.*' => 'required|min:3',
        ]);
        try {
            $soalnya = Soal::with('listJawaban')->find($this->soalId);
            $soalnya->mapel_id = $this->mapelnya->id;
            $soalnya->soal = $this->soal['soal'];
            $soalnya->kunci = $this->kunciId[0];
            $soalnya->bobot_soal = $this->soal['bobot_soal'];
            $soalnya->type_soal = "pilgan";

            $soalnya->update();

            // update listjawaban
            foreach ($this->idListJawaban as $key => $value) {
                $jwbnya = ListJawabansoal::where('keyPilgan', $value)->first();
                $jwbnya->keyPilgan = $this->idListJawaban[$key];
                $jwbnya->type_jawaban = "pilgan";
                $jwbnya->text_jawaban = json_encode($this->soal['text_jawaban'][$key]);

                $jwbnya->update();
            }

            $this->resetInputFields();


            session()->flash('success','Data telah ditambahkan!!');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
        // dd($this->soal);
    }
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
        return view('livewire.soal.updatesoalpilgan');
    }
}
