<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

    <title>@isset($judul)
        {{ $judul }}
    @else
    {{ config('app.name', 'Laravel') }}
    @endisset | Siswa CBTApp</title>

    <!-- vite -->
    @vite(['resources/js/siswa.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Livewire -->
    @livewireStyles

    <!-- custom script head -->
    @stack('script_head')
  </head>
  <body class="bodynya">
    @include('components.siswa.navbar')
    {{ $slot }}

    <!-- jQuery -->
    <script src="{{ asset('vendor/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Livewire -->
    @livewireScripts

    <!-- custom script head -->
    @stack('modals')
    @stack('scripts')
    <!-- AdminLTE for demo purposes -->
    @isset($script_footer)
        {{ $script_footer }}
    @endisset
  </body>
</html>
