<?php

namespace App\Http\Livewire\Siswa;

use App\Models\Ujian;
use Livewire\Component;
use App\Models\IkutUjian;
use App\Models\JawabanUjian;
use App\Models\ListJawabansoal;
use App\Jobs\penilaianUjianSiswa;
use App\Models\SoalnyaSiswaUjian;
use Illuminate\Support\Facades\Auth;

class UjianPlayground extends Component
{
    public $ujian_id, $soal, $listsoal, $soal_id, $listjawaban, $jawaban, $siswaRagu;
    public int $nomor_soal = 1;

    protected $listeners = [
        'hentikanUjian'
    ];

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

        $this->siswaRagu = JawabanUjian::where('siswa_id', Auth::guard('siswa')->user()->id)
                                ->where('ujian_id', $this->ujian_id)
                                ->get()
                                ->toArray();
        $this->soal = Ujian::select('mapel_id','tgl_selesai_ujian','waktu_selesai_ujian')->with([
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

        $u = JawabanUjian::where('siswa_id', Auth::guard('siswa')->user()->id)
                            ->where('ujian_id', $this->ujian_id)
                            ->where('soal_id', $this->soal_id)
                            ->first();
        $this->jawaban['siswa'] = json_decode($u->jawaban_siswa);
        $this->jawaban['ragu-ragu'] = $u->ragu_jawaban;
    }

    public function tombolHentikanUjian()
    {
        // dd($this->soal);
        $this->mount();
        $this->dispatchBrowserEvent('openModal');
    }

    public function hentikanUjian()
    {
        $userId= Auth::guard('siswa')->user()->id;
        $jumlahRagu = JawabanUjian::where('ujian_id', $this->ujian_id)
                            ->where('siswa_id', $userId)
                            ->where('ragu_jawaban', true)
                            ->count();
        if ($jumlahRagu != 0) {
            $this->mount();
            $this->dispatchBrowserEvent('masihAdaRagu');
        } else {
            $this->mount();
            $dt['siswa_id'] = $userId;
            $dt['ujian_id'] = $this->ujian_id;
            penilaianUjianSiswa::dispatch($dt);
            IkutUjian::updateOrCreate([
                'siswa_id' => $userId,
                'ujian_id' => $this->ujian_id
            ],[
                'sudah_ujian' => true
            ]);
            return redirect()->route('siswa.dashboard');
        }
    }
    public function mount(){
        $this->soal = Ujian::select('mapel_id','tgl_selesai_ujian','waktu_selesai_ujian')->with([
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

        // dd($this->soal);

        $this->soal_id = $this->soal->mapel->soals[0]->id;

        $this->listjawaban = ListJawabansoal::where('soal_id', $this->soal_id)->get();

        $u = JawabanUjian::where('siswa_id', Auth::guard('siswa')->user()->id)
                            ->where('ujian_id', $this->ujian_id)
                            ->where('soal_id', $this->soal_id)
                            ->first();
        $this->jawaban['siswa'] = json_decode($u->jawaban_siswa);
        $this->jawaban['ragu-ragu'] = $u->ragu_jawaban;

        $this->siswaRagu = JawabanUjian::where('siswa_id', Auth::guard('siswa')->user()->id)
                                ->where('ujian_id', $this->ujian_id)
                                ->get()
                                ->toArray();
        // dd($this->siswaRagu);
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
