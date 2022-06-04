<div>
    {{-- Do your work, then step back. --}}
    <x-data-table :model="$mapels">
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
                        <span class="fas fa-plus"></span> Tambah Bank Soal
                    </a>
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                {{-- <th><a wire:click.prevent="sortBy('tingkat')" role="button" href="#" style="color: black">
                    Tingkat
                    @include('components.sort-icon', ['field' => 'tingkat'])
                </a></th> --}}
                <th><a wire:click.prevent="sortBy('kode_mapel')" role="button" href="#" style="color: black">
                    Kode Mapel
                    @include('components.sort-icon', ['field' => 'kode_mapel'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_mapel')" role="button" href="#" style="color: black">
                    Nama Mapel
                    @include('components.sort-icon', ['field' => 'nama_mapel'])
                </a></th>
                <th><a wire:click.prevent="sortBy('status_mapel')" role="button" href="#" style="color: black">
                    Status
                    @include('components.sort-icon', ['field' => 'status_mapel'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($mapels as $mpl)
                <tr x-data="window.__controller.dataTableController('{{ $mpl->id }}')">
                    {{-- <td>{{ $mpl->tingkat }}</td> --}}
                    <td>{{ $mpl->kode_mapel }}</td>
                    <td>{{ $mpl->nama_mapel }}</td>
                    <td>
                        @if ($mpl->status_mapel)
                        <a class="btn btn-warning" wire:click.prevent="ubahStatusMapel(false,'{{ $mpl->id }}')">Nonaktifkan</a>
                        @else
                        <a class="btn btn-primary" wire:click.prevent="ubahStatusMapel(true,'{{ $mpl->id }}')">Aktifkan</a>
                        @endif
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.listsoal',  $mpl->id ) }}" class="mr-3"><i class="fa fa-16px fa-eye"></i></a>
                        <a role="button" wire:click.prevent="edit('{{ $mpl->id }}')" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 187, 0)"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem('{{ $mpl->id }}')" href="#"><i class="fa fa-16px fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
<!-- Modal -->

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@if ($jikaUpdate)Ubah @else Tambah @endif Data Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
               <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kode Mapel</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Kode Mapel" wire:model.defer="mapel.kode_mapel" required>
                            @error('mapel.kode_mapel') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Mapel</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama Mapel" wire:model.defer="mapel.nama_mapel" required>
                            @error('mapel.nama_mapel') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">KKM Mapel</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nilai KKM" wire:model.defer="mapel.kkm_mapel" required>
                            @error('mapel.kkm_mapel') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Jumlah Soal Pilihan Ganda</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Jumlah Jumlah Soal Pilihan Ganda" wire:model.defer="mapel.jumlah_pilihan_ganda" required>
                                    @error('mapel.jumlah_pilihan_ganda') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Jumlah Soal Essai</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="Jumlah Jumlah Soal Essai" wire:model.defer="mapel.jumlah_essai" required>
                                    @error('mapel.jumlah_essai') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
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
