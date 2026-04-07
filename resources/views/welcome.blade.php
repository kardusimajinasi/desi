<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Landing Page DESI Surakarta</title>
    
    @filamentStyles
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <h1>Selamat Datang di Dasbor Eksekutif Sumber Daya Informasi</h1>
    </header>

    <main>
        <section>
            @livewire(\App\Filament\Widgets\DashboardBalihoMap::class)
        </section>

        <section class="mt-10">
            {{-- @livewire(\App\Filament\Guest\Resources\TitikBalihoResource\Widgets\GuestBalihoMap::class) --}}
        </section>
    </main>

    @filamentScripts
    @vite('resources/js/app.js')
</body>
</html>