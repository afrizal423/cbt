<x-base.admin>
    <x-slot name="judul">
        Peserta Ujian {{ $siswa->nama_siswa }}
    </x-slot>
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 style="font-size: 16pt">Peserta {!! \Illuminate\Support\Str::limit($siswa->nama_siswa, 20, $end='...') !!}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('guru.ujian.penilaian.peserta_ujian', [
                    'ujianId' => $ujian->id
                ]) }}">Peserta Ujian {{ $ujian->mapel->nama_mapel }}</a></li>
                <li class="breadcrumb-item active">Peserta {!! \Illuminate\Support\Str::limit($siswa->nama_siswa, 15, $end='...') !!}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            @livewire('guru.ujian.table-listsoalpenilaian-ujian', [
                'ujian_id' => $ujian->id,
                'mapel_id' => $ujian->mapel->id,
                'siswa_id' => $siswa->id
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
