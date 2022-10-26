<div>
    <div class="card" style="padding: 20px">
        <div>
            <p style="font-size: 16pt">
                Bobot Soal: {{$soal->bobot_soal}}
            </p>
        </div>

        <div style="padding-top: 5px; padding-left: 10px;  ">
            <p>
                Soal:
            </p>
            <span>
                {!! $soal->soal !!}
            </span>

            <p>
                <b>
                    Kunci Jawaban:
                </b>
            </p>

            <span>
                @foreach ($data_rekomendasi_nilai as $jwban)
                    <li>
                        {{ $jwban->text }}
                    </li>
                @endforeach
                {{-- {!! $data_rekomendasi_nilai !!} --}}
            </span>

            <br>

            <p>
                <b>
                    Jawaban Siswa:
                </b>
            </p>

            <span>
                {!! $jawabanSiswa!!}
            </span>
        </div>
    </div>

    {{-- nilai --}}
    <div class="card" style="padding: 20px">
        <div>
            <p style="font-size: 16pt">
                Nilai Jawaban
            </p>
        </div>

        <div style="padding-top: 5px; padding-left: 10px;  ">
            <p>
                <b style="font-size: 14pt">
                    Rekomendasi nilai: {{ $rekomendasi_bobot_nilai }}
                </b> <br>
                <small>
                    <i>
                        (Rekomendasi nilai bekerja menyamakan antara kunci jawaban dengan jawaban pilihan siswa)
                    </i>
                </small>
            </p>

            <p>
                <b>
                    Persentase Kemiripan jawaban siswa dengan kunci
                </b>
            </p>

            <span>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Kunci Jawaban</th>
                              <th scope="col">Persentase Kemiripan</th>
                              <th scope="col">Nilai <br> <small>(persentase/bobot soal)</small> </th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($data_rekomendasi_nilai as $key => $jwban)
                            <tr>
                              <th scope="row">{{ $key+1 }}</th>
                              <td>{{ $jwban->text }}</td>
                              <td>{{ round($jwban->similarity * 100, 1) }} %</td>
                              <td>{{ round($jwban->similarity, 1) * $soal->bobot_soal }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                    </table>
                </div>
            </span>

            <p>
                <b>
                    Berikan nilai sendiri
                </b>
            </p>

            <span>
                <input
                    type="text"
                    id="judujian"
                    class="form-control"
                    placeholder="Masukkan Judul Ujian"
                    wire:model.defer="bobotnilai"
                    required="required"
                    autocomplete="off">
            </span>

            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a onclick="history.back()" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary float-right" wire:click.prevent="simpanNilai()">Simpan Nilai</button>

            {{-- <input type="submit" value="Tambah Akun" class="btn btn-success float-right"> --}}
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
