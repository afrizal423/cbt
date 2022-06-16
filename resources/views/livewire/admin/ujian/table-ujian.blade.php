<div>
    {{-- Do your work, then step back. --}}
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
                @if (Auth::user()->level == "admin")
                <a href="{{ route('admin.ujian.tambah') }}" class="-ml- btn btn-primary shadow-none">
                    Tambah Ujian
                </a>
                @endif
                @if (Auth::user()->level == "guru")
                <a href="{{ route('guru.ujian.tambah') }}" class="-ml- btn btn-primary shadow-none">
                    Tambah Ujian
                </a>
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
                <th><a wire:click.prevent="sortBy('status_ujian')" role="button" href="#" style="color: black">
                    Akses Ujian
                    @include('components.sort-icon', ['field' => 'status_ujian'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($ujians as $ujn)
                <tr x-data="window.__controller.dataTableController('{{ $ujn->id }}')">
                    <td>
                        {{ $ujn->mapel }}
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
                    <td>
                        @if ($ujn->status_ujian)
                        <a class="btn btn-warning" wire:click.prevent="ubahStatusUjian(false,'{{ $ujn->id }}')">Nonaktifkan</a>
                        @else
                        <a class="btn btn-primary" wire:click.prevent="ubahStatusUjian(true,'{{ $ujn->id }}')">Aktifkan</a>
                        @endif
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        {{-- @if (Auth::user()->level == "admin")
                        <a role="button" href="{{ route('admin.soalshow.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $ujn->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-eye"></i></a>
                        <a role="button" href="{{ route('admin.soaledit.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $ujn->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 187, 0)"></i></a>
                        @endif
                        @if (Auth::user()->level == "guru")
                        <a role="button" href="{{ route('guru.soalshow.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $ujn->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-eye"></i></a>
                        <a role="button" href="{{ route('guru.soaledit.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $ujn->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 187, 0)"></i></a>
                        @endif --}}

                        <a role="button" x-on:click.prevent="deleteItem('{{ $ujn->id }}')" href="#"><i class="fa fa-16px fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>


</div>
