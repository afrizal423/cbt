<x-base.siswa>
    <x-slot name="judul">
        Dashboard Siswa
    </x-slot>
    <div class="container landing-siswa">
        <livewire:siswa.landing/>
    </div>


    @push('script_head')
<style>
    .bodynya {
        background-color: rgb(222, 235, 247);
    }
</style>
@endpush
</x-base.siswa>


