<div>
    <x-data-table :model="$ujians">
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
                <th><a wire:click.prevent="sortBy('mapel')" role="button" href="#" style="color: black">
                    Mapel
                    @include('components.sort-icon', ['field' => 'mapel'])
                </a></th>
                <th><a wire:click.prevent="sortBy('judul')" role="button" href="#" style="color: black">
                    Judul Ujian
                    @include('components.sort-icon', ['field' => 'judul'])
                </a></th>
                <th><a wire:click.prevent="sortBy('jenis_ujian')" role="button" href="#" style="color: black">
                    Jenis Ujian
                    @include('components.sort-icon', ['field' => 'jenis_ujian'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_kelas')" role="button" href="#" style="color: black">
                    Kelas
                    @include('components.sort-icon', ['field' => 'nama_kelas'])
                </a></th>

                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($ujians as $ujn)
                <tr x-data="window.__controller.dataTableController('{{ $ujn->id }}')">
                    <td>
                        <a href="{{ route('guru.listsoal', [
                            'soalId' => $ujn->mapelid
                        ]) }}" target="_blank" rel="noopener noreferrer">{{ $ujn->mapel }}</a>

                    </td>
                    <td>
                        {{ $ujn->judul }}
                    </td>
                    <td>
                        {{ printJenisUjian($ujn->jenis_ujian) }}
                    </td>
                    <td>
                        {{ $ujn->nama_kelas }}
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a href="#" class="-ml- btn btn-outline-primary shadow-none">
                            Nilai Ujian
                        </a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>
</div>
