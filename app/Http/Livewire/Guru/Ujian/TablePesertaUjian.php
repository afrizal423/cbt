<?php

namespace App\Http\Livewire\Guru\Ujian;

use App\Models\IkutUjian;
use Livewire\Component;
use Livewire\WithPagination;

class TablePesertaUjian extends Component
{
    use WithPagination;
    public $model = IkutUjian::class;

    public $perPage = 10;
    public $sortField = "siswas.nisn";
    public $sortAsc = false;
    public $search = '';
    public $ujian_id;

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function get_pagination_data()
    {
        $soalnya = $this->model::search($this->search)
            ->select(
                [
                    'ikut_ujians.id as id',
                    'siswas.id as siswa_id',
                    'siswas.nisn as nisn',
                    'siswas.nama_siswa as nama_siswa',
                    'nilais.nilai_ujian as nilai_ujian'
                    // DB::raw('sum(soals.bobot_soal) as jumlah_bobot_soal')
                ]
            )
            ->where('ikut_ujians.ujian_id', $this->ujian_id)
            ->join('siswas', 'ikut_ujians.siswa_id','=','siswas.id')
            ->leftJoin('nilais', 'ikut_ujians.siswa_id','=','nilais.siswa_id')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.guru.ujian.table-peserta-ujian',
            "pesertanya" => $soalnya
        ];
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        // dd($data['pesertanya']);
        return view($data['view'], $data);
        // return view('livewire.guru.ujian.table-peserta-ujian');
    }
}
