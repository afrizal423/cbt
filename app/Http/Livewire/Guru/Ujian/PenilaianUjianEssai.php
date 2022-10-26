<?php

namespace App\Http\Livewire\Guru\Ujian;

use App\Models\Soal;
use Livewire\Component;
use App\Models\JawabanUjian;
use App\Models\ListJawabansoal;

class PenilaianUjianEssai extends Component
{
    public $ujian_id, $mapel_id, $siswa_id, $soal_id;
    public $soal, $rekomendasi_bobot_nilai;
    public  $jawabanSiswa, $bobotnilai, $data_rekomendasi_nilai;

    public function simpanNilai()
    {
        JawabanUjian::where('ujian_id', $this->ujian_id)
                    ->where('soal_id', $this->soal_id)
                    ->where('siswa_id', $this->siswa_id)
                    ->update([
                        'bobot_nilai' => $this->bobotnilai
                    ]);
        $this->mount();
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
        $this->data_rekomendasi_nilai = json_decode($jsiswa->data_rekomendasi_nilai);
        $jsistem = Soal::where('mapel_id', $this->mapel_id)
                    ->where('id', $this->soal_id)
                    ->first();
        $this->soal = $jsistem;
        $this->jawabanSiswa = json_decode($jsiswa->jawaban_siswa);
        // dd($this->jawabanSiswa);
    }
    public function render()
    {
        return view('livewire.guru.ujian.penilaian-ujian-essai');
    }
}
