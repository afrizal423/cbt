<x-base.admin>
    <x-slot name="judul">
        List Peserta Ujian {{ $data->mapel->nama_mapel }}
    </x-slot>
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Peserta Ujian {{ $data->mapel->nama_mapel }}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('guru.ujian.penilaian.index') }}">Data Penilaian Ujian</a></li>
                <li class="breadcrumb-item active">Peserta Ujian {{ $data->mapel->nama_mapel }}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            @if (\Session::has('fail'))
            <script>
                alert('{!! \Session::get('fail') !!}');
            </script>
            @endif
            @livewire('guru.ujian.table-peserta-ujian', [
                'ujian_id' => $data->id
                ])
        </div>
    </section>

    <x-slot name="script_footer">
        {{-- custom js disini  --}}
        <script type="text/javascript">
           window.addEventListener('openModal', event => {
                $("#exampleModal").modal('show');
            })
            window.addEventListener('tutupModal', event => {
                $('.close-modal').click();
            })
        </script>
    </x-slot>
</x-base.admin>
