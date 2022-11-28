<div>
    {{-- Do your work, then step back. --}}
    <x-data-table :model="$pesertanya">
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
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                      Eksport Data
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('guru.export.nilai_pdf', [
                        'ujian_id' => $ujian_id
                      ]) }}"><i class="fa fa-file-pdf" aria-hidden="true"></i> PDF</a>
                      <a class="dropdown-item" href="{{ route('guru.export.nilai_word', [
                        'ujian_id' => $ujian_id
                      ]) }}"><i class="fa fa-file-word" aria-hidden="true"></i> Word</a>
                      <a class="dropdown-item" href="{{ route('guru.export.nilai_excel', [
                        'ujian_id' => $ujian_id
                      ]) }}"><i class="fa fa-file-excel" aria-hidden="true"></i> Excel</a>
                    </div>
                </div>

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
                <th><a wire:click.prevent="sortBy('nilai_ujian')" role="button" href="#" style="color: black">
                    Nilai
                    @include('components.sort-icon', ['field' => 'nilai_ujian'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($pesertanya as $peserta)
                <tr x-data="window.__controller.dataTableController('{{ $peserta->id }}')">
                    <td>
                        {{ $peserta->nisn }}
                    </td>
                    <td>{!! \Illuminate\Support\Str::limit($peserta->nama_siswa, 20, $end='...') !!}</td>
                    <td>
                        {{ $peserta->nilai_ujian }}
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a href="{{ route('guru.ujian.penilaian.list_soal', [
                            'ujianId' => $ujian_id,
                            'siswaId' => $peserta->siswa_id
                        ]) }}" class="-ml- btn btn-outline-primary shadow-none">
                            Nilai Ujian
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>

</div>
