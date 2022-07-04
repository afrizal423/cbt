<div>
    {{-- Do your work, then step back. --}}
    <x-data-table :model="$siswas">
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
                <th><a wire:click.prevent="sortBy('nisn')" role="button" href="#" style="color: black">
                    NISN
                    @include('components.sort-icon', ['field' => 'nisn'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_siswa')" role="button" href="#" style="color: black">
                    Nama Siswa
                    @include('components.sort-icon', ['field' => 'nama_siswa'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_kelas')" role="button" href="#" style="color: black">
                    Kelas
                    @include('components.sort-icon', ['field' => 'nama_kelas'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($siswas as $siswa)
                <tr x-data="window.__controller.dataTableController('{{ $siswa->id }}')">
                    {{-- <td>{{ $siswa->tingkat }}</td> --}}
                    <td>{{ $siswa->nisn }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $siswa->nama_kelas }}</td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" wire:click.prevent="edit('{{ $siswa->id }}')" class="mr-3"><i class="fa fa-16px fa-pen"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem('{{ $siswa->id }}')" href="#"><i class="fa fa-16px fa-trash" style="color: red"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">@if ($jikaUpdate)Ubah @else Tambah @endif Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
               <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NISN</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan NISN Siswa" wire:model.defer="siswa.nisn" required>
                            @error('siswa.nisn') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Siswa</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama Siswa" wire:model.defer="siswa.nama_siswa" required>
                            @error('siswa.nama_siswa') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Lahir Siswa</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Tanggal lahir Siswa" wire:model.defer="siswa.tgl_lahir_siswa" required>
                            @error('siswa.tgl_lahir_siswa') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alamat Siswa</label>
                            <textarea
                                id="inputAlamat"
                                class="form-control @error('siswa.alamat_siswa') is-invalid @enderror"
                                placeholder="Masukkan Alamat Siswa"
                                wire:model.defer="siswa.alamat_siswa"
                                required="required"></textarea>
                            @error('siswa.alamat_siswa') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <!-- kelas -->
                        <div class="form-group" wire:ignore>
                            <label for="exampleFormControlSelect1">Kelas</label>
                            <select class="form-control" id="kelasnya" wire:model.defer="siswa.kelas_id"style="width: 100%;">
                                <option value="">Silahkan Pilih</option>
                                @foreach ($klsnya as $kls)
                                <option value="{{ $kls->id }}" wire:key="{{ $kls->id }}" @if ($kls->id == $siswa->kelas_id) selected @endif>{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('siswa.kelas_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password Akun Siswa</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Password Akun Siswa" wire:model.defer="siswa.password" required>
                            @error('siswa.password') <span class="text-danger error">{{ $message }}</span>@enderror
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
@push('script_head')
<link href="{{ asset('vendor/adminlte3/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/adminlte3/plugins/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />

@endpush
@push('scripts')
<script src="{{ asset('vendor/adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#kelasnya').select2({
            theme: 'bootstrap4'
        });
        $('#kelasnya').on('change', function (e) {
                var mpl = $('#kelasnya').select2("val");
                // pada params ke 3, jika true artinya defer
                @this.set('siswa.kelas_id', mpl, true);
        });

        @if ($jikaUpdate)
        $('#kelasnya').val("{{ $siswa->kelas_id }}");
        $('#kelasnya').trigger('change');
        @this.set('ujian.kelas_id', "{{ $siswa->kelas_id }}");
        @endif
    });
</script>
@endpush
