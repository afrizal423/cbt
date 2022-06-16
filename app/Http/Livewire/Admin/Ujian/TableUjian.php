<?php

namespace App\Http\Livewire\Admin\Ujian;

use App\Models\Ujian;
use Livewire\Component;
use Livewire\WithPagination;

class TableUjian extends Component
{
    use WithPagination;
    public $model = Ujian::class;
    public $name;

    public $perPage = 10;
    public $sortField = "ujians.id";
    public $sortAsc = false;
    public $search = '';
    protected $listeners = ["deleteItem" => "delete_item", "tutupModal" => "tutupModal"];
    public $soal, $jikaUpdate, $idsoal, $showSoal = [];

    public function ubahStatusUjian(bool $statusnya, string $idnya)
    {
        $dt = $this->model::find($idnya);
        $dt->update([
            "status_ujian" => $statusnya
        ]);
    }
    public function delete_item($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            // dd($id);
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data "
            ]);
            return;
        }

        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data berhasil dihapus!"
        ]);
    }
    public function get_pagination_data()
    {
        $soalnya = $this->model::search($this->search)
            ->select(
                [
                    'ujians.id as id',
                    'mapels.nama_mapel as mapel',
                    'ujians.judul as judul',
                    'ujians.jenis_ujian as jenis_ujian',
                    'kelas.nama_kelas as nama_kelas',
                    'ujians.status_ujian as status_ujian'
                ]
            )
            ->join('mapels', 'mapels.id','=','ujians.mapel_id')
            ->join('kelas', 'kelas.id','=','ujians.kelas_id')
            ->join('gurus', 'gurus.id','=','ujians.guru_id')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.admin.ujian.table-ujian',
            "ujians" => $soalnya
        ];
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        // dd($data['ujians']);
        return view($data['view'], $data);
    }
}
