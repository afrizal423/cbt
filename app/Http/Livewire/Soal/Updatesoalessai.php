<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use App\Models\Mapel;
use Livewire\Component;
use App\Models\ListJawabansoal;

class Updatesoalessai extends Component
{
    public $mapelnya, $action, $soal, $soalId, $mapelId;
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
        unset($this->soal['kunci'][$i+1]);
    }

    public function mount(Mapel $mapelId, $soalId)
    {
        $this->mapelnya = $mapelId;
        $dt = Soal::select(['soal','kunci','list_jawabansoals.text_jawaban'])
            ->join('list_jawabansoals', 'soals.id','=','list_jawabansoals.soal_id')
            ->find($soalId)->toArray();
        $this->soal['soal'] = $dt['soal'];
        $this->soal['kunci'][0] = $dt['kunci'];
        if ($dt['text_jawaban'] != null) {
            $jwbvariasi = json_decode($dt['text_jawaban']);
            foreach ($jwbvariasi as $key => $value) {
                array_push($this->soal['kunci'], $value);
                array_push($this->inputs, $value);;
            }
        }
        $this->i = count($this->soal['kunci']);

        // dd(Soal::select(['soal','kunci','list_jawabansoals.text_jawaban'])
        //     ->join('list_jawabansoals', 'soals.id','=','list_jawabansoals.soal_id')
        //     ->find($soalId)->toArray());
    }

    public function update()
    {
        $this->validate([
            'soal.soal' => 'required|min:6',
            'soal.kunci.0' => 'required|min:3',
            'soal.kunci.*' => 'min:3',
        ]);
        // dd($this->soal['kunci']);
        try {
            $soalnya = Soal::with('listJawaban')->find($this->soalId);
            $soalnya->mapel_id = $this->mapelnya->id;
            $soalnya->soal = $this->soal['soal'];
            $soalnya->kunci = $this->soal['kunci'][0];
            array_splice($this->soal['kunci'],0,1);
            // array_splice()
            // param1 array, param2 yang ingin dihapus, param 3 brp jumlah yng ingin dihapus
            $soalnya->type_soal = "essai";

            $jwbnya = new ListJawabansoal;
            $jwbnya->type_jawaban = "essai";
            $jwbnya->text_jawaban = json_encode($this->soal['kunci']);

            $soalnya->update();
            $soalnya->listJawaban()->update($jwbnya->toArray());
            $this->resetInputFields();


            session()->flash('success','Data telah ditambahkan!!');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.soal.updatesoalessai');
    }
}
