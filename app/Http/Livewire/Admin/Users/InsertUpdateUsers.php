<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InsertUpdateUsers extends Component
{
    use WithFileUploads;
    public $action, $users, $userId;

    public function simpan()
    {
        $this->validate([
            'users.password' => 'required|confirmed|min:6',
            'users.username' => 'required|min:3|unique:users,username',
            'users.email' => 'required|min:6|unique:users,email',
            'users.level' => 'required',
            'users.guru.nama_guru' => 'required|min:3',
            'users.guru.notelp_guru' => 'required|min:11',
            'users.guru.foto_guru' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1024',
        ]);
        // dd($this->users);

        try {
            $akun = new \App\Models\User;
            $akun->email= $this->users['email'];
            $akun->username= $this->users['username'];
            $akun->password= Hash::make($this->users['password']);
            $akun->level = $this->users['level'];


            $biodata = new \App\Models\Guru;
            $biodata->nama_guru = $this->users['guru']['nama_guru'];
            $biodata->alamat_guru = $this->users['guru']['alamat_guru'];
            $biodata->jabatan_guru = $this->users['guru']['jabatan_guru'];
            $biodata->notelp_guru = $this->users['guru']['notelp_guru'];
            if ($this->users['guru']['foto_guru']) {
                $nama_gambar = time() . '_' . $this->users['guru']['foto_guru']->getClientOriginalName();
                $upload = $this->users['guru']['foto_guru']->storeAs('public/'.$this->users['level'].'/user_profile', $nama_gambar);
                $img = Storage::url($upload);
                $biodata->foto_guru = $img;
            }


            $akun->save();
            $akun->guru()->save($biodata);
            session()->flash('success','Data telah ditambahkan!!');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }

        // dd($this->users);
    }

    public function ubah()
    {
        $this->validate([
            'users.password' => 'confirmed|min:6',
            'users.username' => 'min:3|unique:users,username,'.$this->userId,
            'users.email' => 'min:6|unique:users,email,'.$this->userId,
            'users.level' => 'required',
            'users.guru.nama_guru' => 'required|min:3',
            'users.guru.notelp_guru' => 'required|min:11',
            // 'users.guru.foto_guru' => 'image|max:1024',
        ]);
        // dd($this->users);

        try {
            $akun = User::with('guru')->find($this->userId);
            $akun->email= $this->users['email'];
            $akun->username= $this->users['username'];
            if (in_array('password', $this->users)) {
                $akun->password= Hash::make($this->users['password']);
            }
            $akun->level = $this->users['level'];


            $biodata = new \App\Models\Guru;
            $biodata->nama_guru = $this->users['guru']['nama_guru'];
            $biodata->alamat_guru = $this->users['guru']['alamat_guru'];
            $biodata->jabatan_guru = $this->users['guru']['jabatan_guru'];
            $biodata->notelp_guru = $this->users['guru']['notelp_guru'];
            if (in_array('foto_guru', $this->users['guru']) || $this->users['guru']['foto_guru']) {
                $nama_gambar = time() . '_' . $this->users['guru']['foto_guru']->getClientOriginalName();
                $upload = $this->users['guru']['foto_guru']->storeAs('public/'.$this->users['level'].'/user_profile', $nama_gambar);
                $img = Storage::url($upload);
                $biodata->foto_guru = $img;
            }


            $akun->update();
            $akun->guru()->update($biodata->toArray());
            session()->flash('success','Data telah ditambahkan!!');

        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }

        // dd($this->users);
    }

    public function mounted()
    {
        if ($this->action == 'ubahUsers') {
            $dt = User::with('guru')->findOrFail($this->userId);
            // dd($dt->toArray());
            $this->users = $dt->toArray();
        }
    }

    public function render()
    {
        $this->mounted();
        return view('livewire.admin.users.insert-update-users');
    }
}
