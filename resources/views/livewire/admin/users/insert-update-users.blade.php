<div>
    <!-- Main content -->
<section class="content">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data telah disimpan',
            showConfirmButton: true,
            timer: 1800
        }).then(() => {
            history.back();
        })
    </script>
    @endif
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Data Diri Pegawai</h3>

                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nama Pegawai</label>
                            <input
                                type="text"
                                id="inputName"
                                class="form-control @error('users.guru.nama_guru') is-invalid @enderror"
                                placeholder="Masukkan Nama Pegawai"
                                wire:model.defer="users.guru.nama_guru"
                                required="required"
                                autocomplete="name">
                            @error('users.guru.nama_guru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputAlamat">Alamat Pegawai</label>
                            <textarea
                                id="inputAlamat"
                                class="form-control @error('users.guru.alamat_guru') is-invalid @enderror"
                                placeholder="Masukkan Alamat Pegawai"
                                wire:model.defer="users.guru.alamat_guru"
                                required="required"></textarea>
                            @error('users.guru.alamat_guru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputtel">No Telp Pegawai</label>
                            <input
                                type="tel"
                                id="inputtel"
                                class="form-control @error('users.guru.notelp_guru') is-invalid @enderror"
                                placeholder="Masukkan No Telp Pegawai"
                                wire:model.defer="users.guru.notelp_guru"
                                required="required"
                                autocomplete="off">
                            @error('users.guru.notelp_guru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputName">Jabatan Pegawai</label>
                            <input
                                type="text"
                                id="inputName"
                                class="form-control @error('users.guru.jabatan_guru') is-invalid @enderror"
                                placeholder="Masukkan Nama Pegawai"
                                wire:model.defer="users.guru.jabatan_guru"
                                required="required"
                                autocomplete="name">
                            @error('users.guru.jabatan_guru')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputFoto">Foto Pegawai</label>
                            <div class="row">
                                <div class="col-md-4">
                                    @if ($action == 'ubahUsers')
                                    @if ($users['guru']['foto_guru'])
                                    <img
                                    class="elevation-3"
                                    id="prevImg"
                                    src="{{ $users['guru']['foto_guru'] }}"
                                    width="150px"/>
                                    @else
                                    <img
                                    class="elevation-3"
                                    id="prevImg"
                                    src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}"
                                    width="150px"/>
                                    @endif
                                    @else
                                    <img
                                    class="elevation-3"
                                    id="prevImg"
                                    src="{{ asset('vendor/adminlte3/img/user2-160x160.jpg') }}"
                                    width="150px"/>
                                    @endif


                                </div>
                                <div class="col-md-8">
                                    @if ($action == "ubahUsers")
                                        <input
                                        wire:model="foto"
                                        type="file"
                                        id="inputFoto"
                                        accept="image/*"
                                        class="form-control @error('foto') is-invalid @enderror"
                                        placeholder="Upload foto profil">
                                        @error('foto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    @else
                                        <input
                                        wire:model="users.guru.foto_guru"
                                        type="file"
                                        id="inputFoto"
                                        accept="image/*"
                                        class="form-control @error('users.guru.foto_guru') is-invalid @enderror"
                                        placeholder="Upload foto profil">
                                        @error('users.guru.foto_guru')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    @endif

                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Akun Pegawai</h3>

                        <div class="card-tools">
                            <button
                                type="button"
                                class="btn btn-tool"
                                data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input
                                type="text"
                                id="username"
                                class="form-control @error('users.username') is-invalid @enderror"
                                placeholder="Masukkan Nama Pegawai"
                                wire:model.defer="users.username"
                                required="required"
                                autocomplete="name">
                            @error('users.username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input
                                type="email"
                                id="inputEmail"
                                wire:model.defer="users.email"
                                class="form-control @error('users.email') is-invalid @enderror"
                                placeholder="Masukkan Email"
                                required="required"
                                autocomplete="email">
                            @error('users.email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Level Akun</label>
                            <select class="form-control" wire:model.defer="users.level">
                                <option value="">Silahkan Pilih</option>
                                <option value="admin" wire:key="0">Admin</option>
                                <option value="guru" wire:key="1">Guru</option>
                            </select>
                            @error('users.level') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input
                                id="password"
                                type="password"
                                placeholder="Kata Sandi"
                                class="form-control @error('users.password') is-invalid @enderror"
                                wire:model.defer="users.password"
                                required="required"
                                autocomplete="new-password">
                            @error('users.password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Konfirmasi Password</label>
                            <input
                                placeholder="Ketik ulang kata sandi"
                                id="password-confirm"
                                type="password"
                                class="form-control"
                                wire:model.defer="users.password_confirmation"
                                required="required"
                                autocomplete="new-password">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a onclick="history.back()" class="btn btn-secondary">Kembali</a>
                @if ($action == "ubahUsers")
                <button type="submit" class="btn btn-primary float-right" wire:click.prevent="ubah()">Simpan Perubahan</button>
                @else
                <button type="submit" class="btn btn-primary float-right" wire:click.prevent="simpan()">Simpan Data</button>
                @endif
                {{-- <input type="submit" value="Tambah Akun" class="btn btn-success float-right"> --}}
            </div>
        </div>
    </form>
</section>
<!-- /.content -->

@push('scripts')
    <script>
        var selector = document.getElementById("inputtel");
        var im = new Inputmask("9999-9999-9999");
        im.mask(selector);
    </script>
     <script>
        inputFoto.onchange = evt => {
            const [file] = inputFoto.files
            if (file) {
                prevImg.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
</div>


