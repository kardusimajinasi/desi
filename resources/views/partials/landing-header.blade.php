<header class="bg-white shadow-lg sticky top-0" style="z-index: 1100; background: rgba(240, 246, 255, 0.85); backdrop-filter: blur(20px);">
    <div class="mx-auto max-w-7xl px-6 py-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('logo.png') }}" alt="Logo Pemerintah Kota Surakarta" class="h-12">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">DESI</h1>
                <p class="text-sm text-gray-600">Dashboard Eksekutif Sumber Daya Informasi</p>
            </div>
        </div>
        <nav class="hidden md:flex space-x-6">
            <a href="/" class="{{ request()->is('landing') ? 'font-semibold text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">Beranda</a>
            <a href="/titik-baliho" class="{{ request()->is('titik-baliho') ? 'font-semibold text-orange-600' : 'text-gray-700 hover:text-orange-600' }}">Titik Baliho</a>
            <a href="/admin" class="text-gray-700 hover:text-orange-600">Masuk</a>
        </nav>
    </div>
</header>
