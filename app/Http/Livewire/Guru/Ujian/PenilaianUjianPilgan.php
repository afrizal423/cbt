<?php

namespace App\Http\Livewire\Guru\Ujian;

use App\Models\JawabanUjian;
use App\Models\ListJawabansoal;
use App\Models\Soal;
use App\Models\Ujian;
use Livewire\Component;

class PenilaianUjianPilgan extends Component
{
    public $ujian_id, $mapel_id, $siswa_id, $soal_id;
    public $soal, $rekomendasi_bobot_nilai;
    public $jawabanSistem, $jawabanSiswa, $bobotnilai;

    public function simpanNilai()
    {
        JawabanUjian::where('ujian_id', $this->ujian_id)
                    ->where('soal_id', $this->soal_id)
                    ->where('siswa_id', $this->siswa_id)
                    ->update([
                        'bobot_nilai' => $this->bobotnilai
                    ]);
        $this->dispatchBrowserEvent('suksesUbah');
    }
    public function mount()
    {
        // $soalid = $this->soal_id;
        $jsiswa = JawabanUjian::where('ujian_id', $this->ujian_id)
                    ->where('soal_id', $this->soal_id)
                    ->where('siswa_id', $this->siswa_id)
                    ->first();
        $this->bobotnilai = $jsiswa->bobot_nilai;
        $this->rekomendasi_bobot_nilai = $jsiswa->rekomendasi_bobot_nilai;
        $jsistem = Soal::where('mapel_id', $this->mapel_id)
                    ->where('id', $this->soal_id)
                    ->first();
        $this->soal = $jsistem;
        $this->jawabanSistem = ListJawabansoal::select('text_jawaban')
                                ->where('keyPilgan',$jsistem->kunci)
                                ->first();
        $this->jawabanSiswa = ListJawabansoal::select('text_jawaban')
                                ->where('keyPilgan',json_decode($jsiswa->jawaban_siswa))
                                ->first();
        // dd($jsiswa);
    }

    public function render()
    {
        return view('livewire.guru.ujian.penilaian-ujian-pilgan');
    }
}
