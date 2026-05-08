<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'DESI Surakarta - Data Lokasi Baliho dan Status Publikasi')</title>
      <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">

    @vite('resources/css/app.css')
    {{-- @vite('resources/css/app.css', '../build') --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.20/index.global.min.js'></script>

    <style>
        .fc .fc-button-primary {
            background-color: #d97706 !important;
            border-color: #d97706 !important;
            text-transform: capitalize;
        }

        .fc .fc-button-primary:hover {
            background-color: #b45309 !important;
            border-color: #b45309 !important;
        }

        .fc .fc-button-active {
            background-color: #f59e0b !important;
            border-color: #f59e0b !important;
        }

        .fc .fc-button:focus {
            box-shadow: 0 0 0 0.2rem rgba(217, 119, 6, 0.25) !important;
        }

        .fc .fc-toolbar-chunk .fc-button-group {
            gap: 2px;
        }

        .fc .fc-today-button {
            margin-left: 10px !important;
            border-radius: 6px !important;
        }

        .hero-bg {
            background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);
        }

        .batik-bg {
            /* Panggil gambar dengan fungsi asset() */
            background-image: url("{{ asset('asset-batik-1.png') }}");

            /* Buat perulangan hanya secara horizontal */
            background-repeat: repeat-x;

            /* Atur posisi dan ukuran */
            background-position: center;
            background-size: contain;
            /* background-size: auto 100%; */
            background-transparent: 70%;
            /* atau atur tinggi spesifik, misal: auto 100% */
        }
    </style>

    @stack('head')
</head>

<body class="bg-gray-50 text-gray-800">
    @include('partials.landing-header')

    @yield('content')

    @include('partials.landing-footer')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    @livewireScripts
    {{-- @vite('resources/js/app.js', '../build') --}}
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
