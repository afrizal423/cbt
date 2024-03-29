<x-base.authsiswa>
    <x-slot name="judul">
       Halaman Login
    </x-slot>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <div class="h1"><b>CBT</b>App</div>
            Mi Plus Al-Islam Dagangan
          </div>
          <div class="card-body">
            <p class="login-box-msg">Silahkan login dengan akun siswa yang tersedia.</p>

            @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('errors')->first('login_gagal')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            <form action="{{ route('login.proses_login_siswa') }}" method="post">
              @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="NISN" name="nisn">
                    {{-- <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div> --}}
                    @error('nisn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              <div class="input-group mb-3" id="show_hide_password">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true" style="color: rgb(87, 87, 87);"></i></a>
                  </div>
                </div>
                @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
              </div>
              <div class="row">
                <div class="col-8">

                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                </div>
                <!-- /.col -->
              </div>
            </form>


            {{-- <p class="mb-1">
              <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
              <a href="register.html" class="text-center">Register a new membership</a>
            </p> --}}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
    @endpush
</x-base.authsiswa>
