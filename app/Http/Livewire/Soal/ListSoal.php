<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class ListSoal extends Component
{
    use WithPagination;
    public $model = Soal::class;
    public $name;

    public $perPage = 10;
    public $sortField = "soals.id";
    public $sortAsc = false;
    public $search = '';
    protected $listeners = ["deleteItem" => "delete_item", "tutupModal" => "tutupModal"];
    public $soal, $jikaUpdate, $idsoal, $showSoal = [];


    public function openModalSoal()
    {
        // $this->emit('show');
        $this->dispatchBrowserEvent('openModalSoal');
    }



    public function showDataSoal($id)
    {
        $mpl = $this->model::with('listJawaban')->findOrFail($id);
        return response()->json($mpl,200);
    }

    public function delete_item($id)
    {
        $data = $this->model::with('listJawaban')->find($id);

        if (!$data) {
            // dd($data);
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data "
            ]);
            return;
        }
        $data->listJawaban()->delete();
        $data->delete();
        $this->emit("deleteResult", [
            "status" => true,
            "message" => "Data berhasil dihapus!"
        ]);
    }

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
                    'soals.id as id',
                    'soals.soal as soal',
                    'soals.type_soal as type_soal',
                    'soals.bobot_soal as bobot_soal',
                    // DB::raw('sum(soals.bobot_soal) as jumlah_bobot_soal')
                ]
            )
            ->where('id',$this->idsoal)
            // ->join('list_jawabansoals', 'soals.id','=','list_jawabansoals.soal_id')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.soal.list-soal',
            "soals" => $soalnya
        ];
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        // dd($data['soals']);
        return view($data['view'], $data);
    }
}
