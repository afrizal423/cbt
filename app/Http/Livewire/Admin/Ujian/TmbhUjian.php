<?php

namespace App\Http\Livewire\Admin\Ujian;

use App\Models\Kela;
use App\Models\Mapel;
use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TmbhUjian extends Component
{
    public $action, $ujian = [];
    public $kelas, $mapel, $idmapel, $idkelas, $jenisujian;

    public function simpan(){
        // dd(Auth::user()->with('guru')->where('id', Auth::user()->id)->first()->guru->id);
        $this->ujian["guru_id"] = Auth::user()->with('guru')->where('id', Auth::user()->id)->first()->guru->id;
        // dd($this->ujian);
        $this->validate([
            'ujian.mapel_id' => 'required',
            'ujian.kelas_id' => 'required',
            'ujian.judul' => 'required|min:3',
            'ujian.jenis_ujian' => 'required|min:1',
            'ujian.tgl_mulai_ujian' => 'required',
            'ujian.waktu_mulai_ujian' => 'required',
            'ujian.tgl_selesai_ujian' => 'required',
            'ujian.waktu_selesai_ujian' => 'required'
        ]);

        try {
           Ujian::create($this->ujian);
           session()->flash('success','Data telah ditambahkan!!');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function mount(){
        $this->mapel = Mapel::all();
        $this->kelas = Kela::all();
    }
    public function render()
    {
        return view('livewire.admin.ujian.tmbh-ujian');
    }
}
