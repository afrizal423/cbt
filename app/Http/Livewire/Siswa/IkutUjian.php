<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kela;
use App\Models\Ujian;
use Livewire\Component;
use App\Models\IkutUjian as ModelIkutUjian;
use Illuminate\Support\Facades\Auth;

class IkutUjian extends Component
{
    public $biodata, $siswakelas, $listUjian, $ujian_id, $cekSudahUjian;
    public function mount()
    {
        $this->biodata = Auth::guard('siswa')->user();
        $this->cekSudahUjian = ModelIkutUjian::where('siswa_id', $this->biodata->id)->where('ujian_id', $this->ujian_id)->where('sudah_ujian', true)->count();
        $this->siswakelas = Kela::where('id', $this->biodata->kelas_id)->first();
        $this->listUjian = Ujian::with(['guru', 'mapel'])->where('id',$this->ujian_id)->first();
        // dd($this->listUjian);
    }
    public function render()
    {
        return view('livewire.siswa.ikut-ujian');
    }
}
