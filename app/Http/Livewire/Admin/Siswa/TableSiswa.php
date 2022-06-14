<?php

namespace App\Http\Livewire\Admin\Siswa;

use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;

class TableSiswa extends Component
{
    use WithPagination;
    public $model = Siswa::class;
    public $name;

    public $perPage = 10;
    public $sortField = "id";
    public $sortAsc = false;
    public $search = '';
    public $siswa, $jikaUpdate;
    protected $listeners = ["deleteItem" => "delete_item", "tutupModal" => "tutupModal"];

    private function resetInputFields()
    {
        $this->siswa = '';
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
        $this->dispatchBrowserEvent('openModal');
    }
    public function tutupModal()
    {
        $this->dispatchBrowserEvent('tutupModal');
    }
    /**
     * End Listener
     */

     /**
     * Bagian komunikasi data
     */
    public function store()
    {
        $this->validate([
            'siswa.nisn' => 'required|min:3|unique:siswas,nisn|numeric',
            'siswa.nama_siswa' => 'required|min:3',
            'siswa.tgl_lahir_siswa' => 'required|date',
        ]);
        try{
            // Create Category
            $this->model::create($this->siswa);
            $this->tutupModal();

            // Set Flash Message
            session()->flash('success','Siswa Created Successfully!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error',$e);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
    }
    public function update()
    {
        $this->validate([
            'siswa.nisn' => 'required|min:3|unique:siswas,nisn|numeric',
            'siswa.nama_siswa' => 'required|min:3',
            'siswa.tgl_lahir_siswa' => 'required|date',
        ]);

        try {
            // Update
            $div = $this->model::find($this->siswa['id']);
            $div->update($this->siswa);
            $this->tutupModal();


            // Set Flash Message
            session()->flash('success');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', $e);

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }
        $this->jikaUpdate = false;
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
    /**
     * End bagian komunikasi data
     */

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function edit($id)
    {
        $kls = $this->model::findOrFail($id);

        $this->siswa = $kls->toArray();
        // dd($this->siswa);
        // $this->id_divisi = $id;
        $this->jikaUpdate = true;
        $this->openModal();
    }
    public function get_pagination_data()
    {
        $ssw = $this->model::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.admin.siswa.table-siswa',
            "siswas" => $ssw
        ];
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }
}
