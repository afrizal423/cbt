<x-base.admin>
    <x-slot name="judul">
        Tambah Data User
    </x-slot>
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tambah Data User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.data_user') }}">Data User</a></li>
                <li class="breadcrumb-item active">Tambah Data User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <livewire:admin.users.insert-update-users action="tambahUsers"/>
        </div>
    </section>

    <x-slot name="script_footer">
        {{-- custom js disini  --}}
        <script type="text/javascript">
            window.livewire.on('show', () => {
                // console.log("buka modal");
                $('#exampleModal').modal('show');
                $("#exampleModal").appendTo("body");
            });
            window.livewire.on('tutup', () => {
                // console.log("tutup modal");
                $('.close-modal').click();
            });
        </script>

    </x-slot>
</x-base.admin>
