<x-base.siswa>
    <x-slot name="judul">
        Ujian {{$ujian->mapel->nama_mapel}}
    </x-slot>
    <div class="container landing-siswa">
        <livewire:siswa.ujian-playground :ujian_id="request()->ujian_id"
            :nomor_soal="request()->nomor_soal"/>
    </div>


@push('script_head')
<style>
    .bodynya {
        background-color: rgb(222, 235, 247);
    }
</style>
@endpush
</x-base.siswa>


