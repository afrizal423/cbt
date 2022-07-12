<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kela;
use App\Models\Ujian;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class IkutUjian extends Component
{
    public $biodata, $siswakelas, $listUjian, $ujian_id;
    public function mount()
    {
        $this->biodata = Auth::guard('siswa')->user();
        $this->siswakelas = Kela::where('id', $this->biodata->kelas_id)->first();
        $this->listUjian = Ujian::with(['guru', 'mapel'])->where('id',$this->ujian_id)->first();
        // dd($this->listUjian);
    }
    public function render()
    {
        return view('livewire.siswa.ikut-ujian');
    }
}
