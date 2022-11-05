<?php

namespace App\Http\Livewire\Guru\Ujian;

use App\Models\Soal;
use App\Models\Nilai;
use Livewire\Component;
use Livewire\WithPagination;

class TableListsoalpenilaianUjian extends Component
{
    use WithPagination;
    public $model = Soal::class;

    public $perPage = 5;
    public $sortField = "soals.type_soal";
    public $sortAsc = false;
    public $search = '';
    public $ujian_id, $mapel_id, $siswa_id, $total_score;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    private function hitungNA()
    {
        $soalnya = $this->model::cari($this->search)
            ->select(
                [
                    'jawaban_ujians.bobot_nilai as score'
                ]
            )
            ->where('soals.mapel_id', $this->mapel_id)
            ->leftJoin('jawaban_ujians', function ($join) {
                $join->on('soals.id','=','jawaban_ujians.soal_id')
                ->where('jawaban_ujians.siswa_id', $this->siswa_id)
                ->where('jawaban_ujians.ujian_id', $this->ujian_id);
            })

            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->get();
        $this->total_score = array_sum(array_column($soalnya->toArray(), 'score'));
        // dd();
    }

    public function get_pagination_data()
    {
        $this->hitungNA();
        $soalnya = $this->model::cari($this->search)
            ->select(
                [
                    'soals.id as id',
                    'soals.soal as soal',
                    'soals.bobot_soal as point_soal',
                    'soals.type_soal as type_soal',
                    'jawaban_ujians.bobot_nilai as score'
                ]
            )
            ->where('soals.mapel_id', $this->mapel_id)
            ->leftJoin('jawaban_ujians', function ($join) {
                $join->on('soals.id','=','jawaban_ujians.soal_id')
                ->where('jawaban_ujians.siswa_id', $this->siswa_id)
                ->where('jawaban_ujians.ujian_id', $this->ujian_id);
            })

            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
            // ->get();
        // dd($soalnya->toArray());
        return [
            "view" => 'livewire.guru.ujian.table-listsoalpenilaian-ujian',
            "soalnya" => $soalnya
        ];
    }

    public function simpanNilai()
    {
        // memperbarui nilai
        $this->hitungNA();
        // masukkan nilai
        Nilai::updateOrCreate([
            'siswa_id' => $this->siswa_id,
            'ujian_id' => $this->ujian_id
        ], [
            'status_penilaian' => true,
            'nilai_ujian' => $this->total_score
        ]);
        $this->dispatchBrowserEvent('suksesUbah');
    }
    public function render()
    {
        $data = $this->get_pagination_data();
        // dd($data['ujians']);
        return view($data['view'], $data);
    }
}
