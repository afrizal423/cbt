<x-base.admin>
    <x-slot name="judul">
        Dashboard Admin
    </x-slot>
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <p>
                                    <span style="font-size: 16pt">
                                        Jumlah Ujian
                                    </span>
                                </p>
                                <p>
                                    <span style="font-size: 15pt">
                                        {{$ujian}}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <p>
                                    <span style="font-size: 16pt">
                                        Jumlah Mata Pelajaran
                                    </span>
                                </p>
                                <p>
                                    <span style="font-size: 15pt">
                                        {{$mapel}}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                <p>
                                    <span style="font-size: 16pt">
                                        Jumlah Ujian belum dinilai
                                    </span>
                                </p>
                                <p>
                                    <span style="font-size: 15pt">
                                        {{$blmdinilai}}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
</x-base.admin>
