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
                    <i class="fa fa-plus"></i> Tambah Ujian
                </a>
                <a href="{{ route('guru.ujian.penilaian.index') }}" class="-ml- btn btn-primary shadow-none">
                    <i class="fa fa-graduation-cap"></i> Nilai Ujian
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
                    <td>
                        @if ($ujn->status_ujian)
                        <a class="btn btn-warning"  onclick="changeStatusUjian(false, '{{ $ujn->id }}')">Nonaktifkan</a>
                        @else
                        <a class="btn btn-primary"  onclick="changeStatusUjian(true, '{{ $ujn->id }}')">Aktifkan</a>
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
                        @endif--}}
                        @if (Auth::user()->level == "guru")
                        {{-- <a role="button" href="{{ route('guru.soalshow.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $ujn->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-eye"></i></a> --}}
                        <a role="button" wire:click.prevent="show('{{ $ujn->id }}')" class="mr-3"><i class="fa fa-16px fa-search"></i></a>
                        <a role="button" href="{{ route('guru.ujian.ubah',  [
                            'ujianId' => $ujn->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 187, 0)"></i></a>
                        @endif

                        <a role="button" x-on:click.prevent="deleteItem('{{ $ujn->id }}')" href="#"><i class="fa fa-16px fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>


    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lihat Data Ujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
               <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                              <tr>
                                <td>Mapel</td>
                                <td>:</td>
                                <td>{{$ujian['mapel']['nama_mapel']}}</td>
                              </tr>
                              <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td>{{$ujian['kelasnya']['nama_kelas']}}</td>
                              </tr>
                              <tr>
                                <td>Judul Ujian</td>
                                <td>:</td>
                                <td>{{$ujian['judul']}}</td>
                              </tr>
                              <tr>
                                <td>Jenis Ujian</td>
                                <td>:</td>
                                <td>{{$ujian['jenis_ujian']}}</td>
                              </tr>
                              <tr>
                                <td>Tanggal Waktu Mulai Ujian</td>
                                <td>:</td>
                                <td>{{$ujian['tgl_mulai_ujian']}} {{$ujian['waktu_mulai_ujian']}}</td>
                              </tr>
                              <tr>
                                <td>Tanggal Waktu Selesai Ujian</td>
                                <td>:</td>
                                <td>{{$ujian['tgl_selesai_ujian']}} {{$ujian['waktu_selesai_ujian']}}</td>
                              </tr>
                              <tr>
                                <td>Kode Ujian</td>
                                <td>:</td>
                                <td>{{$ujian['code_ujian']}}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeStatusUjian(status, datanya) {
        if (status) {
            Swal.fire({
                title: 'Apakah anda yakin ingin membuka akses ujian?',
                html: "Jika anda membuka akses, siswa dapat mengerjakan, sistem akan menyiapkan soal ujian untuk siswa.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Buka akses ujian!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const dt = {
                        status: status,
                        data: datanya
                    }
                    Livewire.emit('ubahStatusUjian', JSON.stringify(dt));
                }
            })
        } else {
            Swal.fire({
                title: 'Apakah anda yakin ingin menutup akses ujian?',
                html: "Jika anda menutup akses, siswa <b>tidak</b> dapat mengerjakan ujian.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Tutup akses ujian!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Livewire.emit('hentikanUjian');
                    const dt = {
                        status: status,
                        data: datanya
                    }
                    Livewire.emit('ubahStatusUjian', JSON.stringify(dt));
                }
            })
        }
    }

</script>
@endpush
