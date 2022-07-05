<div>
    <div class="row">
        <div class="col-md-9">
            <div class="card border-sidekiri-landing-siswa">
                <div class="card-body">
                  <h1>Daftar Ujian</h1>
                  <small>Pada tanggal {{  Carbon\Carbon::now()->translatedFormat('d F Y'); }}</small>
                </div>
            </div>

            @foreach ($listUjian as $uj)
            @php
                $mulai = Carbon\Carbon::parse($uj->tgl_mulai_ujian.' '.$uj->waktu_mulai_ujian);
                $selesai = Carbon\Carbon::parse($uj->tgl_selesai_ujian.' '.$uj->waktu_selesai_ujian);
            @endphp
            <a href="{{ route('siswa.ikutujian', [
                'ujian_id' => $uj->id
            ]) }}" style="text-decoration: none;" class="text-black">
                <div class="card list-ujian">
                    <div class="card-body">
                      <h3>{{ $uj->mapel->nama_mapel }}</h3>
                      <div>Pengajar: {{ $uj->guru->nama_guru }} | Jumlah Soal: {{ $uj->mapel->jumlah_essai + $uj->mapel->jumlah_pilihan_ganda }} | Durasi: {{$selesai->diffInMinutes($mulai)}} Menit | Dimulai pada jam: {{ Carbon\Carbon::parse($uj->waktu_mulai_ujian)->translatedFormat('h:i A') }} </div>
                      <small>{{ printJenisUjian($uj->jenis_ujian) }}</small>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
        <div class="col-md-3">
            <div class="card border-sidekanan-landing-siswa">
                <div class="card-body text-white">
                    <div class="text-center">
                        <h2 style="margin-top: 0.83em;margin-bottom: 0.83em;">Biodata Peserta:</h2>
                     </div>
                     <div class="table-responsive">
                         <table class="table table-borderless text-white">
                             <tbody>
                               <tr>
                                 <td>NISN</td>
                                 <td>:</td>
                                 <td>{{$biodata->nisn}}</td>
                               </tr>
                               <tr>
                                 <td>Nama</td>
                                 <td>:</td>
                                 <td>{{$biodata->nama_siswa}}</td>
                               </tr>
                               <tr>
                                 <td>Kelas</td>
                                 <td>:</td>
                                 <td>{{$siswakelas->nama_kelas}}</td>
                               </tr>
                             </tbody>
                           </table>
                     </div>
                </div>
            </div>

        </div>
    </div>
</div>
