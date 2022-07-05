<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container-fluid">
      <div class="navbar-brand">
        CBTApp
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        </ul>
        <div class="d-flex">
            <a
            class="btn btn-default btn-flat float-right"
            onclick="logoutSiswa()">
            <form
                id="logout-form-siswa"
                action="{{ route('logout_siswa') }}"
                method="POST"
                style="display: none;">
                @csrf
            </form>
            <i class="fas fa-power-off"></i>
            <span>Logout</span>
        </a>
        </div>
      </div>
    </div>
  </nav>
