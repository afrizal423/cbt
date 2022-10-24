<?php

namespace App\Http\Livewire\Guru\Ujian;

use App\Models\Ujian;
use Livewire\Component;
use Livewire\WithPagination;

class TablePenilaianUjian extends Component
{
    use WithPagination;
    public $model = Ujian::class;
    public $name;

    public $perPage = 10;
    public $sortField = "ujians.id";
    public $sortAsc = false;
    public $search = '';
    public $ujian, $jikaUpdate, $idsoal, $showSoal = [];

    public function get_pagination_data()
    {
        $soalnya = $this->model::search($this->search)
            ->select(
                [
                    'ujians.id as id',
                    'mapels.nama_mapel as mapel',
                    'mapels.id as mapelid',
                    'ujians.judul as judul',
                    'ujians.jenis_ujian as jenis_ujian',
                    'kelas.nama_kelas as nama_kelas',
                    'ujians.status_ujian as status_ujian'
                ]
            )
            ->join('mapels', 'mapels.id','=','ujians.mapel_id')
            ->join('kelas', 'kelas.id','=','ujians.kelas_id')
            ->join('gurus', 'gurus.id','=','ujians.guru_id')
            ->where('status_penilaian_ujian', false)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.guru.ujian.table-penilaian-ujian',
            "ujians" => $soalnya
        ];
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        // dd($data['ujians']);
        return view($data['view'], $data);
    }
    // public function render()
    // {
    //     return view('livewire.guru.ujian.table-penilaian-ujian');
    // }
}
