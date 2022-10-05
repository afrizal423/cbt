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
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" wire:model.defer="jawaban.siswa"></textarea>
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
