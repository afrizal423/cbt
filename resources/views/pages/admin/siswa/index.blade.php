<x-base.admin>
    <x-slot name="judul">
        Data Siswa
    </x-slot>
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Data Siswa</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Data Siswa</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <livewire:admin.siswa.table-siswa/>
        </div>
    </section>

    <x-slot name="script_footer">
        {{-- custom js disini  --}}
        <script type="text/javascript">
           window.addEventListener('openModal', event => {
                $("#exampleModal").modal('show');
            })
            window.addEventListener('tutupModal', event => {
                $('.close-modal').click();
            })
        </script>
    </x-slot>
</x-base.admin>
