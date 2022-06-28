<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@isset($judul)
            {{ $judul }}
        @else
        {{ config('app.name', 'Laravel') }}
        @endisset | Siswa CBTApp</title>

        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link
            rel="stylesheet"
            href="{{ asset('vendor/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte3/css/adminlte.min.css') }}">
        <livewire:styles />
    </head>
    <body class="hold-transition
    @if (Route::is('login'))
    login-page
    @elseif (Route::is('register'))
    register-page
    @else
    login-page
    @endif">
        {{ $slot }}

        <!-- jQuery -->
        <script src="{{ asset('vendor/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('vendor/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('vendor/adminlte3/js/adminlte.min.js') }}"></script>
        <livewire:scripts />
        @stack('scripts')
    </body>
</html>
