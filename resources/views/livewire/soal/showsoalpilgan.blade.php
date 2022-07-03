<section>
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
                    <h1>Lihat Soal</h1>
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
                        <li class="breadcrumb-item active">Show Soal</li>
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
                        {{-- tampilin soal --}}
                        Bobot Soal: {{ $soal['bobot_soal'] }} <br> <br>
                        Soal: <br>
                        {!! $soal['soal'] !!}
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
                        {{-- tampilin jawaban --}}
                        @foreach ($soal['text_jawaban'] as $jwbn)
                            <li>{!! $jwbn !!}</li>
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- end card kunci -->

                <!-- button save -->
            <div class="row">
                <div class="col-12">
                    <a onclick="history.back()" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>


    </section>
</section>

@push('scripts')
<style>
</style>
@endpush
