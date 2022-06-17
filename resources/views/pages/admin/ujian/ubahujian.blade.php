<x-base.admin>
    <x-slot name="judul">
        Edit Ujian
    </x-slot>
    <livewire:admin.ujian.tmbh-ujian action="ubahUjian" :ujianId="request()->ujianId"/>
</x-base.admin>
