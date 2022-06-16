<x-base.auth>
    <x-slot name="judul">
       Halaman Login
    </x-slot>
    <div class="login-box">
        <div class="login-logo">
            <a href="#">
                <b>CBT</b>App</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk memulai sesi anda sebagai <b>admin</b></p>
                {{-- Error Alert --}}
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
                <form action="{{ route('login.proses_login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input
                            id="username"
                            type="text"
                            placeholder="Username"
                            class="form-control @error('username') is-invalid @enderror"
                            name="username"
                            value="{{ old('username') }}"
                            required="required"
                            autocomplete="username"
                            autofocus="autofocus">
                        {{-- <input type="username" class="form-control" placeholder="username" autocomplete="off"> --}}
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        {{-- <input type="password" class="form-control" placeholder="Password"> --}}
                        <input
                            id="password"
                            type="password"
                            placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required="required"
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
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
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Ingat sesi saya
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign in using Google+
                    </a>
                </div> --}}
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
                    <a href="{{ route('password.request') }}">Lupa password?</a>
                </p>
                <p class="mb-0">
                    Belum mempunyai akun?
                    <a href="{{ route('register') }}" class="text-center">Register</a>
                </p> --}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</x-base.auth>
