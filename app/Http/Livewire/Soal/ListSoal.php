<?php

namespace App\Http\Livewire\Soal;

use App\Models\Soal;
use Livewire\Component;
use Livewire\WithPagination;

class ListSoal extends Component
{
    use WithPagination;
    public $model = Soal::class;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';
    protected $listeners = ["deleteItem" => "delete_item", "tutupModal" => "tutupModal"];
    public $soal, $jikaUpdate, $listsoal;

    public function get_pagination_data()
    {
        $soalnya = $this->model::search($this->search)
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
        // dd($this->listsoal);
        return view($data['view'], $data);
    }
}
