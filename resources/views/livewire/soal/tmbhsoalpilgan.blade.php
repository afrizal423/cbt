<section>
    @if ($jumlahSoalMapel == $jumlahSoal)
        <script>
            alert("Soal pilihan ganda sudah penuh dari kuota !");
            window.location = "{{ route('guru.listsoal',  $mapelnya->id ) }}";
        </script>
    @endif
    @if(session()->has('success'))
                <script>
                Swal.fire(
                        'Berhasil!',
                        'Data telah tersimpan di database.',
                        'success'
                    ).then(function() {
                        @if(Auth::user()->level == "admin")
                        window.location = "{{ route('admin.listsoal',  $mapelnya->id ) }}";
                        @endif
                        @if(Auth::user()->level == "guru")
                        window.location = "{{ route('guru.listsoal',  $mapelnya->id ) }}";
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
                    <h1>Tambah Soal Pilihan Ganda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.banksoal') }}">Bank Soal</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.listsoal',  $mapelnya->id ) }}">Soal
                                {{$mapelnya->nama_mapel}}</a>
                        </li>
                        <li class="breadcrumb-item active">Tambah Soal Pilihan ganda</li>
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
                    <div class="card-header">
                        <h3 class="card-title"></h3>
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
                            <label for="inputName">Bobot Soal</label>
                            <input
                                type="number"
                                id="inputName"
                                class="form-control @error('soal.bobot_soal') is-invalid @enderror"
                                placeholder="Masukkan Bobot Nilai Pada Soal Ini"
                                wire:model.defer="soal.bobot_soal"
                                required="required"
                                autocomplete="name">
                            @error('soal.bobot_soal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group" wire:ignore>
                            <label for="soal">Soal</label>
                            <textarea
                                name="inputSoalEssai"
                                id="soal"
                                class="form-control @error('soal.soal') is-invalid @enderror"
                                placeholder="Masukkan Soal"
                                wire:model.defer="soal.soal"
                                required="required"></textarea>
                            @error('soal.soal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                {{-- end card soal --}}

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Pilihan Jawaban</h3>
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
                        <div class="form-group" >
                            @foreach ($idListJawaban as $key => $val )
                            <div class="row">
                                <div class="col-1">
                                    <small>Kunci jawaban?</small><br>
                                    <div class="icheck-peterriver d-inline">
                                        <input type="checkbox" id="checkboxPrimary{{$key}}" wire:model="kunciId" value="{{$val}}"
                                        @if (count($kunciId) >= 1 && $kunciId[0] != $val)
                                            disabled
                                        @endif
                                        >
                                        <label for="checkboxPrimary{{$key}}">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-11" wire:ignore>
                                    <textarea
                                        name="text_jawaban{{$key}}"
                                        class="form-control @error('soal.text_jawaban.{{$key}}') is-invalid @enderror"
                                        placeholder="Masukkan Pilihan Jawaban"
                                        wire:model.defer="soal.text_jawaban.{{$key}}" rows="5"
                                        ></textarea>
                                    @error('soal.text_jawaban.{{$key}}')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            @endforeach
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- end card kunci -->

                <!-- button save -->
            <div class="row">
                <div class="col-12">
                    <a onclick="history.back()" class="btn btn-secondary">Cancel</a>
                    @if ($action == "ubahUsers")
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

@push('scripts')
<style>
</style>
@endpush

<x-slot name="script_footer">
    {{-- custom js disini  --}}
    {{-- <script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script> --}}
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<script>
  var options = {
    // Customizing list of languages available in the Language drop-down.
    language_list: ['ar:Arabic:rtl', 'fr:French', 'he:Hebrew:rtl', 'es:Spanish'],
    height: 270,
    scayt_customerId: '1:Eebp63-lWHbt2-ASpHy4-AYUpy2-fo3mk4-sKrza1-NsuXy4-I1XZC2-0u2F54-aqYWd1-l3Qf14-umd',
    scayt_sLang: 'auto',
    removeButtons: 'PasteFromWord',
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
  const editor = CKEDITOR.replace('inputSoalEssai', options);
        editor.on('change', function(event){
            // console.log(event.editor.getData())
            // ubah message jadi variable ke simpan db nantinya
            // pada params ke 3, jika true artinya defer
            @this.set('soal.soal', event.editor.getData(), true);
        })
//   CKEDITOR.replace('inputJawaban0', options);

@foreach ($idListJawaban as $key => $val )
const editor{{$key}} = CKEDITOR.replace('text_jawaban{{$key}}', options);
        editor{{$key}}.on('change', function(event){
            // console.log(event.editor.getData())
            // ubah message jadi variable ke simpan db nantinya
            // pada params ke 3, jika true artinya defer
            @this.set('soal.text_jawaban.{{$key}}', event.editor.getData(), true);
        })
@endforeach
</script>
</x-slot>
