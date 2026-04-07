@extends('layouts.landing')

@section('title', 'Peta Baliho | DESI Surakarta')

@section('content')
    <section class="hero-bg text-white py-24">
        <div class="mx-auto max-w-7xl px-6 text-center">
            <p class="uppercase tracking-[0.35em] text-sm font-semibold text-white/85 mb-4">Titik Baliho</p>
            <h2 class="text-4xl md:text-6xl font-bold mb-4">Temukan Lokasi dan informasi Baliho di Kota Surakarta</h2>
            <p class="text-lg md:text-xl text-white/90 max-w-3xl mx-auto mb-8">Halaman ini menampilkan peta lokasi baliho yang dikelola oleh Dinas Komunikasi, Informatika Statistik dan Persandian Kota Surakarta.</p>
            <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                <a href="#peta" class="bg-white text-orange-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">Lihat Peta Sekarang</a>
                <a href="/" class="border border-white/40 text-white px-6 py-3 rounded-lg font-semibold hover:bg-white/10">Kembali ke Beranda</a>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-7xl p-6 space-y-12 mb-6">

        <section id="peta" class="bg-white rounded-3xl shadow-xl overflow-hidden">
            {{-- <div class="px-6 py-8 border-b border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900">Peta Persebaran Baliho</h3>
                <p class="text-gray-600 mt-2">Navigasi peta untuk melihat titik baliho di seluruh wilayah Surakarta, lengkap dengan detail publikasi.</p>
            </div> --}}
            <livewire:titik-baliho />
        </section>

        <section class="grid gap-6 md:grid-cols-3">
            <div class="rounded-3xl bg-white p-6 shadow-lg">
                <h4 class="text-lg font-semibold mb-3 text-gray-900">Data Terverifikasi</h4>
                <p class="text-gray-600">Semua baliho pada peta telah diverifikasi dan diperbarui secara berkala untuk akurasi publik.</p>
            </div>
            <div class="rounded-3xl bg-white p-6 shadow-lg">
                <h4 class="text-lg font-semibold mb-3 text-gray-900">Cari Baliho</h4>
                <p class="text-gray-600">Gunakan filter untuk mencari lokasi baliho dengan cepat.</p>
            </div>
            <div class="rounded-3xl bg-white p-6 shadow-lg">
                <h4 class="text-lg font-semibold mb-3 text-gray-900">Akses Publik</h4>
                <p class="text-gray-600">Halaman ini dibuat untuk mempermudah akses informasi lokasi baliho oleh masyarakat dan pihak terkait.</p>
            </div>
        </section>
    </main>
@endsection
