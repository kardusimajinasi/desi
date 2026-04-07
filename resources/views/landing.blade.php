@extends('layouts.landing')

@section('title', 'DESI Surakarta - Data Lokasi Baliho dan Status Publikasi')

@section('content')
    <section class="hero-bg text-white py-20">
        <div class="mx-auto max-w-7xl px-6 text-center">
            <h2 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di Dashboard Eksekutif Sumber Daya Informasi</h2>
            <p class="text-xl md:text-2xl mb-8">Platform monitoring data publikasi media cetak dan elektronik di Kota Surakarta</p>
            <div class="flex justify-center flex-col gap-4 sm:flex-row sm:items-center sm:justify-center">
                <a href="#peta" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-semibold">Lihat Persebaran Baliho</a>
                <a href="#kalender" class="bg-white text-orange-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">Kalender Publikasi</a>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-7xl p-6 space-y-12 mb-6">
        <section id="peta" class="bg-white rounded-3xl shadow-xl overflow-hidden">
            {{-- <div class="px-6 py-8 border-b border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">Peta Baliho</h3>
                <p class="text-gray-600 mt-2">Lihat posisi baliho di Surakarta dan temukan informasi publikasi secara interaktif.</p>
            </div> --}}
            <livewire:public-baliho-map />
        </section>

        <section id="kalender" class="bg-white rounded-3xl shadow-xl overflow-hidden">
            {{-- <div class="px-6 py-8 border-b border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">Kalender Publikasi</h3>
                <p class="text-gray-600 mt-2">Pantau jadwal publikasi media cetak dan elektronik dengan mudah dalam satu tampilan.</p>
            </div> --}}
            <livewire:kalender-publikasi />
        </section>
    </main>
@endsection
