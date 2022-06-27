<?php

namespace App\Http\Livewire\Soal;

use App\Models\ListJawabansoal;
use App\Models\Mapel;
use App\Models\Soal;
use Livewire\Component;

class Tmbhsoalessai extends Component
{
    public $mapelnya, $action, $soal;
    public $inputs = [];
    public $i = 1;

    private function resetInputFields()
    {
        $this->soal = '';
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
        // dd($this->i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function simpan()
    {
        $this->validate([
            'soal.soal' => 'required|min:6',
            'soal.bobot_soal' => 'required|numeric',
            'soal.kunci.0' => 'required|min:3',
            'soal.kunci.*' => 'min:3',
        ]);
        // dd($this->soal);
        try {
            $soalnya = new Soal;
            $soalnya->mapel_id = $this->mapelnya->id;
            $soalnya->soal = $this->soal['soal'];
            $soalnya->kunci = $this->soal['kunci'][0];
            $soalnya->bobot_soal = $this->soal['bobot_soal'];
            array_splice($this->soal['kunci'],0,1);
            // array_splice()
            // param1 array, param2 yang ingin dihapus, param 3 brp jumlah yng ingin dihapus
            $soalnya->type_soal = "essai";

            $jwbnya = new ListJawabansoal;
            $jwbnya->type_jawaban = "essai";
            $jwbnya->text_jawaban = json_encode($this->soal['kunci']);

            $soalnya->save();
            $soalnya->listJawaban()->save($jwbnya);
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
        // dd($soalId);
    }

    public function render()
    {
        return view('livewire.soal.tmbhsoalessai');
    }
}
