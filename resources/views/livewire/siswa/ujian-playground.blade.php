<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header font-header-card-ujian d-flex justify-content-between">
                    Soal No. {{$nomor_soal}}
                    <div class="card-summary">Sisa Waktu </div>
                </div>
                <div class="card-body">
                    <div class="card-text">
                        {!! $soal->mapel->soals[0]->soal !!}
                    </div>
                </div>
            </div>

            {{-- tombol  --}}
            <div class="row" style="padding-top: 12px">
                <div class="col-md-4">
                    @if ($nomor_soal != 1)
                    <a href="
                    @php
                        echo route('ujian_playground', [
                            'ujian_id' => $ujian_id,
                            'nomor_soal' => $nomor_soal-1
                        ]);
                    @endphp
                    " class="btn btn-primary" role="button">Soal Sebelumnya</a>
                    @endif

                </div>
                <div class="col-md-4 text-center">
                    1
                </div>
                <div class="col-md-4 text-end">
                    @if ($nomor_soal != count($listsoal))
                    <a href="
                        @php
                            echo route('ujian_playground', [
                                'ujian_id' => $ujian_id,
                                'nomor_soal' => $nomor_soal+1
                            ]);
                        @endphp
                    " class="btn btn-primary" role="button">Soal Selanjutnya</a>
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
                                <a href="
                                @php
                                    echo route('ujian_playground', [
                                        'ujian_id' => $ujian_id,
                                        'nomor_soal' => $i+1
                                    ]);
                                @endphp
                                " class="btn
                                @if ($i+1 == $nomor_soal)
                                btn-primary
                                @else
                                btn-outline-primary
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
