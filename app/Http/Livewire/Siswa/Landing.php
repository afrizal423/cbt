<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Kela;
use App\Models\Ujian;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Landing extends Component
{
    public $biodata, $siswakelas, $listUjian;
    public function mount()
    {
        $this->biodata = Auth::guard('siswa')->user();
        $this->siswakelas = Kela::where('id', $this->biodata->kelas_id)->first();
        $this->listUjian = Ujian::with(['guru', 'mapel'])
                            ->where('kelas_id', $this->biodata->kelas_id)
                            // ->where('tgl_mulai_ujian',Carbon::today()->toDateString())
                            ->where('status_ujian', true)
                            ->get();
        // dd($this->listUjian);
    }
    public function render()
    {
        return view('livewire.siswa.landing');
    }
}
