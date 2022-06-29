<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@isset($judul)
            {{ $judul }}
        @else
        {{ config('app.name', 'Laravel') }}
        @endisset | Laravel 9 - AdminLTE 3</title>
        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="{{ asset('font/font.css') }}">
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte3/css/adminlte.min.css') }}">
        @livewireStyles
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <!-- Alpine Plugins -->
        <script src="{{ asset('inputmask.min.js') }}" ></script>
        @stack('script_head')
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            @include('components.admin.navbar')

            @include('components.admin.sidebar')

            <div class="content-wrapper">
                {{ $slot }}
            </div>

            @include('components.footer')

            @include('components.control_sidebar')
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('vendor/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('vendor/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('vendor/adminlte3/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="../../dist/js/demo.js"></script> --}}
        @livewireScripts
        {{-- <script src="{{ asset('js/alpine.js') }}"></script> --}}

        @stack('modals')
        @stack('scripts')
        <!-- AdminLTE for demo purposes -->
        @isset($script_footer)
            {{ $script_footer }}
        @endisset
    </body>
</html>
