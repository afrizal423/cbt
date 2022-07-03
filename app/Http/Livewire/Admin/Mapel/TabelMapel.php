<?php

namespace App\Http\Livewire\Admin\Mapel;

use App\Models\Mapel;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class TabelMapel extends Component
{
    use WithPagination;
    public $model = Mapel::class;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';
    protected $listeners = ["deleteItem" => "delete_item", "tutupModal" => "tutupModal"];
    public $mapel, $jikaUpdate;

    private function resetInputFields()
    {
        $this->mapel = '';
    }

    /**
     * Listener atau function yang bukan komunikasi data
     * alias popup,dll
     */
    public function ubahstatus()
    {
        $this->jikaUpdate = false;
    }
    public function tambah()
    {
        $this->resetInputFields();
        $this->ubahstatus();
        $this->openModal();
    }
    public function openModal()
    {
        // $this->emit('show');
        $this->dispatchBrowserEvent('openModal');
    }
    public function tutupModal()
    {
        // $this->emit('tutup');
        $this->dispatchBrowserEvent('tutupModal');
    }
    /**
     * End Listener
     */

    public function store()
    {
        // dd($this->mapel);
        $this->validate([
            'mapel.kode_mapel' => 'required|min:3|max:30',
            'mapel.nama_mapel' => 'required|min:3|max:30',
            'mapel.kkm_mapel' => 'required|numeric',
            'mapel.jumlah_pilihan_ganda' => 'required|numeric',
            'mapel.jumlah_opsi_jawaban' => 'numeric',
            'mapel.jumlah_essai' => 'required|numeric',
        ]);

        try{
            // Create Category
            $this->model::create($this->mapel);
            $this->tutupModal();

            // Set Flash Message
            session()->flash('success','Created Successfully!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error','Something goes wrong while creating category!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
    }

    public function edit($id)
    {
        $mpl = $this->model::findOrFail($id);

        $this->mapel = $mpl->toArray();
        $this->jikaUpdate = true;
        $this->openModal();
    }

    public function update()
    {
        // dd($this->mapel);
        $this->validate([
            'mapel.kode_mapel' => 'required|min:3|max:100',
            'mapel.nama_mapel' => 'required|min:3|max:100',
            'mapel.kkm_mapel' => 'required|numeric',
            'mapel.jumlah_pilihan_ganda' => 'required|numeric',
            'mapel.jumlah_opsi_jawaban' => 'numeric',
            'mapel.jumlah_essai' => 'required|numeric',
        ]);

        try{
            // Create Category
            $mpl = $this->model::find($this->mapel['id']);
            $mpl->update($this->mapel);
            $this->tutupModal();

            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error',$e);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
    }

    public function delete_item($id)
    {
        $data = $this->model::find($id);

        if (!$data) {
            dd($data);
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
        $unit_kerjas = $this->model::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.admin.mapel.tabel-mapel',
            "mapels" => $unit_kerjas
        ];
    }

    public function ubahStatusMapel(bool $statusnya, string $idnya)
    {
        $dt = $this->model::find($idnya);
        $dt->update([
            "status_mapel" => $statusnya
        ]);
    }

    public function render()
    {
        $data = $this->get_pagination_data();
        // dd($data);
        return view($data['view'], $data);
    }
}
