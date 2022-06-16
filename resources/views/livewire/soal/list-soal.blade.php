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
                <a href="" class="-ml- btn btn-primary shadow-none">
                    <span class="fas fa-check"></span> Tambah Soal Pilihan Ganda
                </a>
                <a href="{{ route('admin.soaltambah.essai', [
                    'soalId' => $idsoal]) }}" class="-ml- btn btn-primary shadow-none">
                    <span class="fas fa-align-justify"></span> Tambah Soal Essai
                </a>
            </div>
        </x-slot>
        <x-slot name="head">
            <tr>
                <th><a wire:click.prevent="sortBy('soal')" role="button" href="#" style="color: black">
                    Pertanyaan
                    @include('components.sort-icon', ['field' => 'soal'])
                </a></th>
                <th><a wire:click.prevent="sortBy('type_soal')" role="button" href="#" style="color: black">
                    Type Soal
                    @include('components.sort-icon', ['field' => 'type_soal'])
                </a></th>
                <th>Action</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($soals as $mpl)
                <tr x-data="window.__controller.dataTableController('{{ $mpl->id }}')">
                    <td>{!! \Illuminate\Support\Str::limit($mpl->soal, 50, $end='...') !!}</td>
                    <td>
                        {{ $mpl->type_soal }}
                    </td>
                    <td class="whitespace-no-wrap row-action--icon">
                        @if (Auth::user()->level == "admin")
                        <a role="button" href="{{ route('admin.soalshow.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $mpl->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-eye"></i></a>
                        <a role="button" href="{{ route('admin.soaledit.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $mpl->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 187, 0)"></i></a>
                        @endif
                        @if (Auth::user()->level == "guru")
                        <a role="button" href="{{ route('guru.soalshow.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $mpl->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-eye"></i></a>
                        <a role="button" href="{{ route('guru.soaledit.essai',  [
                            'mapelId' => $idsoal,
                            'soalId' => $mpl->id
                        ] ) }}" class="mr-3"><i class="fa fa-16px fa-pen" style="color: rgb(255, 187, 0)"></i></a>
                        @endif

                        <a role="button" x-on:click.prevent="deleteItem('{{ $mpl->id }}')" href="#"><i class="fa fa-16px fa-trash" style="color: red"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-data-table>

    <div wire:ignore.self class="modal fade" id="modalDetailSoal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
               <div class="modal-body">
                    <div class="container">
                        <div>
                            <!-- soal -->
                            <p>Soal:</p>
                            <div class="soal">
                            </div>
                        </div>
                        <div>
                            <!-- jawaban -->
                            <p>Jawaban:</p>
                            <div class="jawaban">
                            </div>
                            <div class="listjawaban">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="script_footer">
        {{-- custom js disini  --}}
        <script type="text/javascript">
            function showDtails(soalId){
                $.ajax({
                            url : `/api/${soalId}/soalDetail`,
                            headers : {
                                'Content-Type':'application/json'
                            },
                            type: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success:function(data){

                                $('.soal').html(data.soal)
                                $('.jawaban').html(data.kunci)
                                console.log(data);

                            },

                        });
            }
            window.addEventListener('openModal', event => {
                $("#exampleModal").modal('show');
            })
            window.addEventListener('tutupModal', event => {
                $('.close-modal').click();
            })
        </script>
    </x-slot>
</div>
