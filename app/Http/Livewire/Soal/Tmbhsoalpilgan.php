<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use App\Models\Mapel;
use Rorecek\Ulid\Ulid;
use Livewire\Component;
use App\Models\ListJawabansoal;

class Tmbhsoalpilgan extends Component
{
    public $mapelnya, $action, $soal, $jumlahPilihan, $kunciId = [];
    public $idListJawaban= [];
    public $inputs = [];

    private function resetInputFields()
    {
        $this->soal = '';
        $this->jumlahPilihan = [];
        $this->kunciId = [];
    }

    public function simpan()
    {
        $this->validate([
            'soal.soal' => 'required|min:6',
            'soal.bobot_soal' => 'required|numeric',
            'soal.text_jawaban.*' => 'required|min:3',
        ]);
        // dd($this->soal);
        try {
            $soalnya = new Soal;
            $soalnya->mapel_id = $this->mapelnya->id;
            $soalnya->soal = $this->soal['soal'];
            $soalnya->kunci = $this->kunciId[0];
            $soalnya->bobot_soal = $this->soal['bobot_soal'];
            $soalnya->type_soal = "pilgan";

            $tmpjwb=[];
            $jwbnya = new ListJawabansoal;
            foreach ($this->idListJawaban as $key => $value) {
                $jwbnya->keyPilgan = $this->idListJawaban[$key];
                $jwbnya->type_jawaban = "pilgan";
                $jwbnya->text_jawaban = json_encode($this->soal['text_jawaban'][$key]);
                // dd($jwbnya);
                array_push($tmpjwb, $jwbnya->toArray());
            }
            // dd($tmpjwb);

            $soalnya->save();
            $soalnya->listJawaban()->createMany($tmpjwb);
            $this->resetInputFields();


            session()->flash('success','Data telah ditambahkan!!');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function mount(Mapel $soalId)
    {
        $this->mapelnya = $soalId;
        $this->jumlahPilihan = Mapel::select('jumlah_opsi_jawaban')
                                ->where('id', $this->mapelnya->id)
                                ->first();
        $ulid = new Ulid;
        for ($i=0; $i < $this->jumlahPilihan['jumlah_opsi_jawaban'] ; $i++) {
            array_push($this->idListJawaban, $ulid->generate());
        }
        // dd($this->idListJawaban);
    }
    public function render()
    {
        return view('livewire.soal.tmbhsoalpilgan');
    }
}
