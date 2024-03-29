<?php

namespace App\Http\Livewire\Admin\Ujian;

use App\Models\Kela;
use App\Models\Mapel;
use App\Models\Ujian;
use Livewire\Component;
use App\Models\IkutUjian;
use Illuminate\Support\Facades\Auth;
use App\Jobs\inisialisasiKehadiranUjian;
use App\Models\Nilai;

class TmbhUjian extends Component
{
    public $action, $ujian = [];
    public $kelas, $mapel, $idmapel, $idkelas, $jenisujian, $ujianId;

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
            'ujian.waktu_selesai_ujian' => 'required',
            'ujian.keterlambatan_ujian' => 'numeric',
        ]);

        try {
           $uj = Ujian::create($this->ujian);
           $dt['ujian_id'] = $uj->id;
           $dt['kelas_id'] = $uj->kelas_id;
           $dt['status'] = 'baru';
           inisialisasiKehadiranUjian::dispatch($dt);
           session()->flash('success','Data telah ditambahkan!!');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function ubah()
    {
        $this->validate([
            'ujian.mapel_id' => 'required',
            'ujian.kelas_id' => 'required',
            'ujian.judul' => 'required|min:3',
            'ujian.jenis_ujian' => 'required|min:1',
            'ujian.tgl_mulai_ujian' => 'required',
            'ujian.waktu_mulai_ujian' => 'required',
            'ujian.tgl_selesai_ujian' => 'required',
            'ujian.waktu_selesai_ujian' => 'required',
            'ujian.keterlambatan_ujian' => 'numeric',
        ]);
        // dd($this->ujian);
        try {
            $u = Ujian::findOrFail($this->ujianId);
            $u->update($this->ujian);
            // IkutUjian::where('ujian_id', $this->ujianId)->delete();
            // Nilai::where('ujian_id', $this->ujianId)->delete();
            $dt['ujian_id'] = $u->id;
            $dt['kelas_id'] = $u->kelas_id;
            $dt['status'] = 'ubah';
            inisialisasiKehadiranUjian::dispatch($dt);
            session()->flash('success','Data telah ditambahkan!!');
         } catch (\Exception $e) {
             //throw $th;
             dd($e);
         }
    }

    public function mount(){
        $this->mapel = Mapel::where('status_mapel', true)->get();
        $this->kelas = Kela::all();
        if ($this->action == "ubahUjian") {
            $this->ujian = Ujian::findOrFail($this->ujianId)->toArray();
            $this->idmapel = $this->ujian['mapel_id'];
            $this->idkelas = $this->ujian['kelas_id'];
            $this->jenisujian = $this->ujian['jenis_ujian'];
            // dd($this->ujian);
        }
    }
    public function render()
    {
        return view('livewire.admin.ujian.tmbh-ujian');
    }
}
