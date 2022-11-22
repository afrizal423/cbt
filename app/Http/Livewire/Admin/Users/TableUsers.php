<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TableUsers extends Component
{
    use WithPagination;
    public $model = User::class;
    public $name;

    public $perPage = 10;
    public $sortField = "users.username";
    public $sortAsc = true;
    public $search = '';
    public $kelas, $jikaUpdate;
    protected $listeners = ["deleteItem" => "delete_item", "tutupModal" => "tutupModal"];

    private function resetInputFields()
    {
        $this->kelas = '';
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
        $this->emit('show');
    }
    public function tutupModal()
    {
        $this->emit('tutup');
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
            'kelas.kode_kelas' => 'required',
            'kelas.tingkat' => 'required',
            'kelas.nama_kelas' => 'required'
        ]);
        try{
            // Create Category
            $this->model::create($this->kelas);
            $this->tutupModal();

            // Set Flash Message
            session()->flash('success','Category Created Successfully!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();
        }catch(\Exception $e){
            // Set Flash Message
            session()->flash('error','Something goes wrong while creating category!!');

            // Reset Form Fields After Creating Category
            $this->resetInputFields();

        }
    }
    public function update()
    {
        $this->validate([
            'kelas.kode_kelas' => 'required',
            'kelas.tingkat' => 'required',
            'kelas.nama_kelas' => 'required'
        ]);

        try {
            // Update
            $div = $this->model::find($this->kelas['id']);
            $div->update($this->kelas);
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
        $data = $this->model::with('guru')->find($id);

        if (!$data) {
            dd($data);
            $this->emit("deleteResult", [
                "status" => false,
                "message" => "Gagal menghapus data "
            ]);
            return;
        }
        if($data->guru->foto_guru && file_exists(public_path().$data->guru->foto_guru)){
            unlink(public_path().$data->guru->foto_guru);
            // dd('sukses hapus');
        }
        $data->guru()->delete();
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

        $this->kelas = $kls->toArray();
        // dd($this->kelas);
        // $this->id_divisi = $id;
        $this->jikaUpdate = true;
        $this->openModal();
    }
    public function get_pagination_data()
    {
        $user = $this->model::search($this->search)
            // ->whereHas('guru')
            ->select(['users.id','users.email', 'users.username', 'users.level',
                        'gurus.nama_guru as namanya_guru', 'gurus.jabatan_guru as jabatan_guru',
                        'gurus.notelp_guru as notelpnya_guru'])
            ->join('gurus', 'users.id','=','gurus.user_id')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return [
            "view" => 'livewire.admin.users.table-users',
            "userses" => $user
        ];
    }

    public function render()
    {
        $data = $this->get_pagination_data();

        return view($data['view'], $data);
    }

    // public function render()
    // {
    //     return view('livewire.admin.users.table-users');
    // }
}
