<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card border-sidekiri-landing-siswa">
                <div class="card-body">
                    <h2>Konfirmasi Data</h2>
                    @php
                        $sekarang = Carbon\Carbon::now();
                        $mulai = Carbon\Carbon::parse($listUjian->tgl_mulai_ujian.' '.$listUjian->waktu_mulai_ujian);
                        $selesai = Carbon\Carbon::parse($listUjian->tgl_selesai_ujian.' '.$listUjian->waktu_selesai_ujian);
                        $result = $sekarang->gte($mulai);

                        if ($result) {
                            echo "hai";
                        };
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-borderless">
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
                            <tr>
                                <td>Guru</td>
                                <td>:</td>
                                <td>{{$listUjian->guru->nama_guru}}</td>
                            </tr>
                            <tr>
                                <td>Mata Pelajaran</td>
                                <td>:</td>
                                <td>{{$listUjian->mapel->nama_mapel}}</td>
                            </tr>
                            <tr>
                                <td>Nama Ujian</td>
                                <td>:</td>
                                <td>{{$listUjian->judul}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Ujian</td>
                                <td>:</td>
                                <td>{{printJenisUjian($listUjian->jenis_ujian)}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Soal</td>
                                <td>:</td>
                                <td>{{ $listUjian->mapel->jumlah_essai + $listUjian->mapel->jumlah_pilihan_ganda }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Soal Pilihan Ganda</td>
                                <td>:</td>
                                <td>{{ $listUjian->mapel->jumlah_pilihan_ganda }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Soal Essai</td>
                                <td>:</td>
                                <td>{{ $listUjian->mapel->jumlah_essai}}</td>
                            </tr>
                            <tr>
                                <td>Durasi Ujian</td>
                                <td>:</td>
                                <td>{{$selesai->diffInMinutes($mulai)}} Menit</td>
                            </tr>
                            <tr>
                                <td>Dimulai Pada Jam</td>
                                <td>:</td>
                                <td>{{ Carbon\Carbon::parse($listUjian->waktu_mulai_ujian)->translatedFormat('h:i A') }}</td>
                            </tr>
                            <tr>
                                <td>Token Ujian</td>
                                <td>:</td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card border-sidekanan-ikutujian-siswa">
                <div class="card-body">
                    <div class="box-ikutujian-kanan">
                        Waktu boleh mengerjakan ujian adalah saat tombol "MULAI" berwarna hijau!
                    </div>
                    <div id="demo">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script>
    // Mengatur waktu akhir perhitungan mundur
var countDownDate = new Date("{{$listUjian->tgl_mulai_ujian.' '}}07:09:30").getTime();

// Memperbarui hitungan mundur setiap 1 detik
var x = setInterval(function() {

  // Untuk mendapatkan tanggal dan waktu hari ini
  var now = new Date().getTime();

  // Temukan jarak antara sekarang dan tanggal hitung mundur
  var distance = countDownDate - now;

  // Perhitungan waktu untuk hari, jam, menit dan detik
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Keluarkan hasil dalam elemen dengan id = "demo"
  document.getElementById("demo").innerHTML = hours + ":"
  + minutes + ":" + seconds + "";

  // Jika hitungan mundur selesai, tulis beberapa teks
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
@endpush
