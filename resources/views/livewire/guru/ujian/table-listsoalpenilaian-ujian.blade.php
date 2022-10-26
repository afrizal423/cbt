<div>
    {{-- Do your work, then step back. --}}
    <x-data-table :model="$soalnya">
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

            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('soal')" role="button" href="#" style="color: black">
                    Pertanyaan
                    @include('components.sort-icon', ['field' => 'soal'])
                </a></th>
                <th><a wire:click.prevent="sortBy('point_soal')" role="button" href="#" style="color: black">
                    Point Soal
                    @include('components.sort-icon', ['field' => 'point_soal'])
                </a></th>
                <th><a wire:click.prevent="sortBy('type_soal')" role="button" href="#" style="color: black">
                    Type Soal
                    @include('components.sort-icon', ['field' => 'type_soal'])
                </a></th>
                <th><a wire:click.prevent="sortBy('score')" role="button" href="#" style="color: black">
                    Score
                    @include('components.sort-icon', ['field' => 'score'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($soalnya as $soal)
                <tr x-data="window.__controller.dataTableController('{{ $soal->id }}')">
                    <td>{!! \Illuminate\Support\Str::limit($soal->soal, 50, $end='...') !!}</td>
                    <td>
                        {{ $soal->point_soal }}
                    </td>
                    <td>
                        {{ $soal->type_soal }}
                    </td>
                    <td>
                        {{ $soal->score }}
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a href="{{ route('guru.ujian.penilaian.nilai_soal', [
                            'ujianId' => $ujian_id,
                            'siswaId' => $siswa_id,
                            'soalId' => $soal->id
                        ]) }}" class="-ml- btn btn-outline-primary shadow-none">
                            Beri Nilai
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>

    <div class="card" style="padding: 20px">
        <div class="row">
            <div class="col-6">
                <h1 style="font-size: 16pt"><b>
                    Nilai Akhir:
                </b>
            </h1>
            <span style="font-size: 25px">
                <b>
                    {{$total_score}}
                </b>
            </span>
            </div>
            <div class="col-6" style="padding-top: 20px">
                <span class="float-right">
                    <a class="-ml- btn btn-primary shadow-none" wire:click.prevent="simpanNilai()">
                        Simpan Nilai
                    </a>
                </span>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    window.addEventListener('suksesUbah', event => {
        Swal.fire({
            icon: 'success',
            title: 'Nilai telah disimpan',
            showConfirmButton: false,
            timer: 1800
        }).then(() => {
            location.reload();
        })
        // location.reload()
    })
</script>
@endpush
