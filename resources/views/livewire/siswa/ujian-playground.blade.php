<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-header-card-ujian d-flex justify-content-between">
                    Soal No. {{$nomor_soal}}
                    <div class="card-summary">Sisa Waktu <span id="demo"></span></div>
                </div>
                <div class="card-body">
                    <div class="card-text">
                        {!! $soal->mapel->soals[0]->soal !!}
                        <br>
                        @if ($soal->mapel->soals[0]->type_soal == "pilgan")
                        @foreach ($listjawaban as $jwban)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" wire:model.defer="jawaban.siswa" value="{{$jwban->id}}">
                                <label class="form-check-label" for="flexRadioDefault1">
                                {!! json_decode($jwban->text_jawaban) !!}
                                </label>
                            </div>
                        @endforeach

                        {{-- @php
                            var_dump($listjawaban);
                        @endphp --}}
                        @else
                        <div class="jawaban-essai">
                            <textarea class="form-control" rows="8" wire:model.defer="jawaban.siswa"></textarea>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- tombol  --}}
            <div class="row" style="padding-top: 12px">
                <div class="col-md-4">
                    @if ($nomor_soal != 1)
                    <a  wire:click="showSoal({{$nomor_soal-1}})" class="btn btn-primary" role="button">Soal Sebelumnya</a>
                    @endif

                </div>
                <div class="col-md-4 text-center" style="padding-top: 10px">
                    <div class="">
                        <input class="form-check-input" type="checkbox" value="@php
                            true;
                        @endphp" wire:model.defer="jawaban.ragu-ragu">
                        <label class="form-check-label" for="flexCheckDefault">Ragu - ragu
                        </label>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    @if ($nomor_soal != count($listsoal))
                    <a wire:click="showSoal({{$nomor_soal+1}})" class="btn btn-primary" role="button">Soal Selanjutnya</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header font-header-card-ujian">
                  Nomor Soal
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <div class="row">
                            @for ($i = 0; $i < count($listsoal); $i++)
                            <div class="col-md">
                                <a wire:click="showSoal({{$i+1}})" class="btn
                                @if ($i+1 == $nomor_soal)
                                @foreach ($siswaRagu as $ragu)
                                        @if ($ragu['soal_id'] == $listsoal[$i] && $ragu['ragu_jawaban'])
                                            btn-warning
                                            @break
                                        @elseif ($ragu['soal_id'] == $listsoal[$i])
                                            btn-primary
                                        @endif
                                @endforeach
                                @else
                                    @foreach ($siswaRagu as $ragu)
                                        @if ($ragu['soal_id'] == $listsoal[$i] && $ragu['ragu_jawaban'])
                                            btn-warning
                                            @break
                                        @elseif ($ragu['soal_id'] == $listsoal[$i])
                                            btn-outline-primary
                                        @endif
                                    @endforeach
                                @endif" role="button">{{$i+1}}</a>
                            </div>
                            @endfor
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
@php
    $mulai = Carbon\Carbon::parse($soal->tgl_selesai_ujian.' '.$soal->waktu_selesai_ujian);
@endphp
<script>
    // Mengatur waktu akhir perhitungan mundur
var countDownDate = new Date("{{$mulai}}").getTime();

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
    location.reload();
  }
}, 1000);
</script>
@endpush
