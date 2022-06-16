<section>
    @if(session()->has('success'))
                <script>
                Swal.fire(
                        'Berhasil!',
                        'Data telah tersimpan di database.',
                        'success'
                    ).then(function() {
                        @if(Auth::user()->level == "admin")
                        window.location = "{{ route('admin.ujian.index',  $mapelnya->id ) }}";
                        @endif
                        @if(Auth::user()->level == "guru")
                        window.location = "{{ route('guru.ujian.index' ) }}";
                        @endif
                    });
                </script>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
        </div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Ujian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('guru.dashboard') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('guru.ujian.index') }}">List Ujian</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Ujian</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <!-- isi konten -->
        <div class="container">
                <div class="card card-primary">
                    <div class="card-body">
                        <!-- mapel -->
                        <div class="form-group" wire:ignore>
                            <label for="exampleFormControlSelect1">Mata Pelajaran</label>
                            <select class="form-control" id="mapelnya" wire:model.defer="ujian.mapel"style="width: 100%;">
                                <option value="">Silahkan Pilih</option>
                                @foreach ($mapel as $mpl)
                                <option value="{{ $mpl->id }}" wire:key="{{ $mpl->id }}" @if ($mpl->id == $idmapel) selected @endif>{{ $mpl->nama_mapel }}</option>
                                @endforeach
                            </select>
                            @error('ujian.mapel') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <!-- kelas -->
                        <div class="form-group" wire:ignore>
                            <label for="exampleFormControlSelect1">Kelas</label>
                            <select class="form-control" id="kelasnya" wire:model.defer="ujian.mapel"style="width: 100%;">
                                <option value="">Silahkan Pilih</option>
                                @foreach ($kelas as $kls)
                                <option value="{{ $kls->id }}" wire:key="{{ $kls->id }}" @if ($kls->id == $idkelas) selected @endif>{{ $kls->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('ujian.mapel') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <!-- judul ujian -->
                        <div class="form-group">
                            <label for="judujian">Judul Ujian</label>
                            <input
                                type="text"
                                id="judujian"
                                class="form-control @error('ujian.judul') is-invalid @enderror"
                                placeholder="Masukkan Judul Ujian"
                                wire:model.defer="ujian.judul"
                                required="required"
                                autocomplete="off">
                            @error('ujian.judul')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <!-- jenis ujian -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jenis Ujian</label>
                            <select class="form-control" id="jenisujian" wire:model.defer="ujian.jenis_ujian"style="width: 100%;">
                                <option value="">Silahkan Pilih</option>
                                <option value="QZ" wire:key="QZ" @if ($jenisujian == "Quiz") selected @endif>Quiz</option>
                                <option value="UH" wire:key="UH" @if ($jenisujian == "UH") selected @endif>Ujian Harian</option>
                                <option value="UTS" wire:key="UTS" @if ($jenisujian == "UTS") selected @endif>Ujian Tengah Semester</option>
                                <option value="UAS" wire:key="UAS" @if ($jenisujian == "UAS") selected @endif>Ujian Akhir Semester</option>
                            </select>
                            @error('ujian.jenis_ujian') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <!-- waktu tgl mulai ujian -->
                        <div class="row">
                            <div class="col">
                                 <!-- tgl mulai ujian -->
                                 <div class="form-group">
                                    <label for="judujian">Tanggal Mulai Ujian</label>
                                    <input
                                        type="date"
                                        id="judujian"
                                        class="form-control @error('ujian.tgl_mulai_ujian') is-invalid @enderror"
                                        wire:model.defer="ujian.tgl_mulai_ujian"
                                        required="required"
                                        autocomplete="off">
                                    @error('ujian.tgl_mulai_ujian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <!-- waktu mulai ujian -->
                                <div class="form-group">
                                    <label for="judujian">Waktu Mulai Ujian</label>
                                    <input
                                        type="time"
                                        id="judujian"
                                        class="form-control @error('ujian.waktu_mulai_ujian') is-invalid @enderror"
                                        wire:model.defer="ujian.waktu_mulai_ujian"
                                        required="required"
                                        autocomplete="off">
                                    @error('ujian.waktu_mulai_ujian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- waktu tgl selesai ujian -->
                        <div class="row">
                            <div class="col">
                                 <!-- tgl selesai ujian -->
                                 <div class="form-group">
                                    <label for="judujian">Tanggal Selesai Ujian</label>
                                    <input
                                        type="date"
                                        id="judujian"
                                        class="form-control @error('ujian.tgl_selesai_ujian') is-invalid @enderror"
                                        wire:model.defer="ujian.tgl_selesai_ujian"
                                        required="required"
                                        autocomplete="off">
                                    @error('ujian.tgl_selesai_ujian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <!-- waktu selesai ujian -->
                                <div class="form-group">
                                    <label for="judujian">Waktu Selesai Ujian</label>
                                    <input
                                        type="time"
                                        id="judujian"
                                        class="form-control @error('ujian.waktu_selesai_ujian') is-invalid @enderror"
                                        wire:model.defer="ujian.waktu_selesai_ujian"
                                        required="required"
                                        autocomplete="off">
                                    @error('ujian.waktu_selesai_ujian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- KOde ujian -->
                        <div class="form-group">
                            <label for="judujian">Kode Ujian</label>
                            <input
                                type="text"
                                id="judujian"
                                class="form-control @error('ujian.code_ujian') is-invalid @enderror"
                                placeholder="Masukkan Kode Ujian"
                                wire:model.defer="ujian.code_ujian"
                                required="required"
                                autocomplete="off">
                            @error('ujian.code_ujian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                    </div>
                    <!-- /.card-body -->
                </div>
                {{-- end card soal --}}

                <!-- button save -->
            <div class="row">
                <div class="col-12">
                    <a onclick="history.back()" class="btn btn-secondary">Cancel</a>
                    @if ($action == "ubahUjian")
                    <button type="submit" class="btn btn-primary float-right" wire:click.prevent="ubah()">Simpan Perubahan</button>
                    @else
                    <button type="submit" class="btn btn-primary float-right" wire:click.prevent="simpan()">Simpan Data</button>
                    @endif
                    {{-- <input type="submit" value="Tambah Akun" class="btn btn-success float-right"> --}}
                </div>
            </div>
        </div>


    </section>

</section>
@push('script_head')
<link href="{{ asset('vendor/adminlte3/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/adminlte3/plugins/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" />

@endpush


<x-slot name="script_footer">
    {{-- custom js disini  --}}
    <script src="{{ asset('vendor/adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#mapelnya').select2({
      theme: 'bootstrap4'
    });
    $('#mapelnya').on('change', function (e) {
            var mpl = $('#mapelnya').select2("val");
            // pada params ke 3, jika true artinya defer
            @this.set('ujian.mapel_id', mpl);
    });

    $('#kelasnya').select2({
      theme: 'bootstrap4'
    });
    $('#kelasnya').on('change', function (e) {
            var mpl = $('#kelasnya').select2("val");
            // pada params ke 3, jika true artinya defer
            @this.set('ujian.kelas_id', mpl);
    });
});
</script>
</x-slot>
