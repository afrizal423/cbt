<?php

namespace App\Http\Livewire\Siswa;

use App\Models\JawabanUjian;
use App\Models\ListJawabansoal;
use App\Models\Ujian;
use Livewire\Component;
use App\Models\SoalnyaSiswaUjian;
use Illuminate\Support\Facades\Auth;

class UjianPlayground extends Component
{
    public $ujian_id, $soal, $listsoal, $soal_id, $listjawaban, $jawaban;
    public int $nomor_soal = 1;

    public function showSoal($nosoal){
        // dd($this->jawaban);
        JawabanUjian::updateOrCreate([
            'siswa_id' => Auth::guard('siswa')->user()->id,
            'ujian_id' => $this->ujian_id,
            'soal_id' => $this->soal_id],
            [
                'jawaban_siswa' => isset($this->jawaban['siswa']) ? json_encode($this->jawaban['siswa']) : null,
                'ragu_jawaban' => isset($this->jawaban['ragu-ragu']) ? $this->jawaban['ragu-ragu'] : false
            ]
        );
        $this->soal = Ujian::select('mapel_id')->with([
            'mapel' => function($q) use($nosoal){
                $q->select('id');
                $q->with(
                    [
                        'soals' => function($q) use($nosoal){
                            $siswa = Auth::guard('siswa')->user();
                            $ambilIdSoal = SoalnyaSiswaUjian::where('siswa_id', $siswa->id)
                                    ->where('ujian_id', $this->ujian_id)->first();
                            $this->listsoal = json_decode($ambilIdSoal->listsoal);
                            $q->select('id', 'mapel_id', 'soal', 'type_soal', 'bobot_soal');
                            $q->where('id', $this->listsoal[$nosoal-1]);
                            $q->first();
                        }
                    ]
                );
            }
        ])->where('id',$this->ujian_id)->first();

        $this->soal_id = $this->soal->mapel->soals[0]->id;

        $this->listjawaban = ListJawabansoal::where('soal_id', $this->soal_id)->get();

        $this->nomor_soal = $nosoal;
    }

    public function mount(){

        $this->soal = Ujian::select('mapel_id')->with([
            'mapel' => function($q){
                $q->select('id');
                $q->with(
                    [
                        'soals' => function($q){
                            $siswa = Auth::guard('siswa')->user();
                            $ambilIdSoal = SoalnyaSiswaUjian::where('siswa_id', $siswa->id)
                                    ->where('ujian_id', $this->ujian_id)->first();
                            $this->listsoal = json_decode($ambilIdSoal->listsoal);
                            $q->select('id', 'mapel_id', 'soal', 'type_soal', 'bobot_soal');
                            $q->where('id', $this->listsoal[$this->nomor_soal-1]);
                            $q->first();
                        }
                    ]
                );
            }
        ])->where('id',$this->ujian_id)->first();

        $this->soal_id = $this->soal->mapel->soals[0]->id;

        $this->listjawaban = ListJawabansoal::where('soal_id', $this->soal_id)->get();

        JawabanUjian::updateOrCreate([
            'siswa_id' => Auth::guard('siswa')->user()->id,
            'ujian_id' => $this->ujian_id,
            'soal_id' => $this->soal_id],
            [
                'jawaban_siswa' => isset($this->jawaban['siswa']) ? json_encode($this->jawaban['siswa']) : null,
                'ragu_jawaban' => isset($this->jawaban['ragu-ragu']) ? $this->jawaban['ragu-ragu'] : false
            ]
        );
    }
    public function render()
    {
        return view('livewire.siswa.ujian-playground');
    }
}
