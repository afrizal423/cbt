<div>
    {{-- Do your work, then step back. --}}
    <x-data-table :model="$soals">
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
                @php
                    $linksoalessai = Enkripsi("tmbhessai");
                    $linksoalpilgan = Enkripsi("tmbhpilgan");
                @endphp
                @if ($listsoal['jumlah_soalpilgan'] < $listsoal['identitas_soal']->jumlah_pilihan_ganda)
                <a href="" class="-ml- btn btn-primary shadow-none">
                    <span class="fas fa-check"></span> Tambah Soal Pilihan Ganda
                </a>
                @elseif ($listsoal['jumlah_essai'] < $listsoal['identitas_soal']->jumlah_essai)
                <a href="{{ route('admin.soaltambah.essai', [
                    'soalId' => $listsoal['identitas_soal']->id,
                    'q' => $linksoalessai]) }}" class="-ml- btn btn-primary shadow-none">
                    <span class="fas fa-align-justify"></span> Tambah Soal Essai
                </a>
                @else
                Soal sudah terisi semua untuk ujian mata pelajaran {{$listsoal['identitas_soal']->nama_mapel}}.
                @endif
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('kode_mapel')" role="button" href="#" style="color: black">
                    Kode Mapel
                    @include('components.sort-icon', ['field' => 'kode_mapel'])
                </a></th>
                <th><a wire:click.prevent="sortBy('nama_mapel')" role="button" href="#" style="color: black">
                    Nama Mapel
                    @include('components.sort-icon', ['field' => 'nama_mapel'])
                </a></th>
                <th><a wire:click.prevent="sortBy('status_mapel')" role="button" href="#" style="color: black">
                    Status
                    @include('components.sort-icon', ['field' => 'status_mapel'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            {{-- @foreach ($mapels as $mpl)
                <tr x-data="window.__controller.dataTableController('{{ $mpl->id }}')">
                    <td>{{ $mpl->kode_mapel }}</td>
                    <td>{{ $mpl->nama_mapel }}</td>
                    <td>
                        @if ($mpl->status_mapel)
                        <a class="btn btn-warning" wire:click.prevent="ubahStatusMapel(false,'{{ $mpl->id }}')">Nonaktifkan</a>
                        @else
                        <a class="btn btn-primary" wire:click.prevent="ubahStatusMapel(true,'{{ $mpl->id }}')">Aktifkan</a>
                        @endif
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a role="button" href="{{ route('admin.listsoal',  $mpl->id ) }}" class="mr-3"><i class="fa fa-16px fa-eye"></i></a>
                        <a role="button" wire:click.prevent="edit('{{ $mpl->id }}')" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 187, 0)"></i></a>
                        <a role="button" x-on:click.prevent="deleteItem('{{ $mpl->id }}')" href="#"><i class="fa fa-16px fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
            @endforeach --}}
        </x-slot>
    </x-data-table>

</div>
