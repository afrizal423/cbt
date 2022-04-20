<div>
    {{-- Do your work, then step back. --}}
    <x-data-table :model="$userses">
        <x-slot name="inputdata">
            <div style="padding: 20px">
                @if(session()->has('success'))
                <script>
                Swal.fire(
                        'Berhasil!',
                        'Data telah tersimpan di database.',
                        'success'
                    );
                </script>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif

                      <a href="" class="-ml- btn btn-primary shadow-none" wire:click.prevent="tambah()">
                        <span class="fas fa-plus"></span> Tambah Data
                    </a>
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('username')" role="button" href="#" style="color: black">
                    Username
                    @include('components.sort-icon', ['field' => 'username'])
                </a></th>
                <th><a wire:click.prevent="sortBy('gurus.nama_guru')" role="button" href="#" style="color: black">
                    Nama
                    @include('components.sort-icon', ['field' => 'gurus.nama_guru'])
                </a></th>
                <th><a wire:click.prevent="sortBy('gurus.jabatan_guru')" role="button" href="#" style="color: black">
                    Jabatan
                    @include('components.sort-icon', ['field' => 'gurus.jabatan_guru'])
                </a></th>
                <th><a wire:click.prevent="sortBy('gurus.notelp_guru')" role="button" href="#" style="color: black">
                    No Telp
                    @include('components.sort-icon', ['field' => 'gurus.notelp_guru'])
                </a></th>
                <th><a wire:click.prevent="sortBy('email')" role="button" href="#" style="color: black">
                    Email
                    @include('components.sort-icon', ['field' => 'email'])
                </a></th>
                <th><a wire:click.prevent="sortBy('level')" role="button" href="#" style="color: black">
                    Level
                    @include('components.sort-icon', ['field' => 'level'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($userses as $usrs)
                <tr x-data="window.__controller.dataTableController('{{ $usrs->id }}')">
                    <td>{{ $usrs->username }}</td>
                    <td>{{ $usrs->namanya_guru }}</td>
                    <td>{{ $usrs->jabatan_guru }}</td>
                    <td>{{ $usrs->notelpnya_guru }}</td>
                    <td>{{ $usrs->email }}</td>
                    <td>{{ $usrs->level }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="edit('{{ $usrs->id }}')" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem('{{ $usrs->id }}')" href="#"><i class="fa fa-16px fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
<!-- Modal -->

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@if ($jikaUpdate)Ubah @else Tambah @endif Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
               <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tingkat Kelas</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Tingkat Kelas" wire:model.defer="kelas.tingkat" required>
                            @error('kelas.tingkat') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kode Kelas</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Kode Kelas" wire:model.defer="kelas.kode_kelas" required>
                            @error('kelas.kode_kelas') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Kelas</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama Kelas" wire:model.defer="kelas.nama_kelas" required>
                            @error('kelas.nama_kelas') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
                    @if ($jikaUpdate)
                        <button type="button" class="btn btn-primary" wire:click.prevent="update()">Ubah Data</button> <br>
                        @else
                        <button class="btn btn-primary text-right" wire:click.prevent="store()">Simpan Data</button>

                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
