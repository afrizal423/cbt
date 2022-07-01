<?php

namespace App\Http\Livewire\Soal;

use App\Models\Mapel;
use Livewire\Component;
use Rorecek\Ulid\Ulid;

class Tmbhsoalpilgan extends Component
{
    public $mapelnya, $action, $soal, $jumlahPilihan, $kunciId;
    public $idListJawaban= [];
    public $inputs = [];

    public function simpan()
    {
        // $this->validate([
        //     'soal.soal' => 'required|min:6',
        //     'soal.bobot_soal' => 'required|numeric',
        //     'soal.text_jawaban.*' => 'required|min:3',
        // ]);
        dd($this->soal);
        // try {
        //     $soalnya = new Soal;
        //     $soalnya->mapel_id = $this->mapelnya->id;
        //     $soalnya->soal = $this->soal['soal'];
        //     $soalnya->kunci = $this->soal['kunci'][0];
        //     $soalnya->bobot_soal = $this->soal['bobot_soal'];
        //     array_splice($this->soal['kunci'],0,1);
        //     // array_splice()
        //     // param1 array, param2 yang ingin dihapus, param 3 brp jumlah yng ingin dihapus
        //     $soalnya->type_soal = "essai";

        //     $jwbnya = new ListJawabansoal;
        //     $jwbnya->type_jawaban = "essai";
        //     $jwbnya->text_jawaban = json_encode($this->soal['kunci']);

        //     $soalnya->save();
        //     $soalnya->listJawaban()->save($jwbnya);
        //     $this->resetInputFields();


        //     session()->flash('success','Data telah ditambahkan!!');
        // } catch (\Exception $e) {
        //     //throw $th;
        //     dd($e);
        // }
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
