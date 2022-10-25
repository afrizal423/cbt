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
                        <a href="" wire:click.prevent="show('{{ $ujn->id }}')"">{{ $ujn->judul }}</a>
                    </td>
                    <td>
                        {{ printJenisUjian($ujn->jenis_ujian) }}
                    </td>
                    <td>
                        {{ $ujn->nama_kelas }}
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        <a href="{{ route('guru.ujian.penilaian.peserta_ujian', [
                            'ujianId' => $ujn->id
                        ]) }}" class="-ml- btn btn-outline-primary shadow-none">
                            Nilai Ujian
                        </a>
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
                                <td>Jumlah Peserta Mengikuti Ujian</td>
                                <td>:</td>
                                <td>{{$ujian['jumlah_ikut_ujian']}}</td>
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
