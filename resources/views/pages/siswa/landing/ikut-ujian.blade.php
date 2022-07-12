<x-base.siswa>
    <x-slot name="judul">
        Ikut Ujian
    </x-slot>
    <div class="container landing-siswa">
        <livewire:siswa.ikut-ujian :ujian_id="request()->ujian_id"/>
    </div>


@push('script_head')
<style>
    .bodynya {
        background-color: rgb(222, 235, 247);
    }
</style>
@endpush
</x-base.siswa>


