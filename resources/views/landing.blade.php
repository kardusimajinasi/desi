@extends('layouts.landing')

@section('title', 'Halaman Utama DETIK | Dashboard Eksekutif Tata Kelola MedIa Komunikasi')

@section('content')
    <section class="hero-bg relative text-white py-20 overflow-hidden">
        {{-- <section class="hero-bg text-white py-20"> --}}
        <div class="absolute inset-0 z-0 batik-bg opacity-15"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-6 text-center">
            {{-- <div class="mx-auto max-w-7xl px-6 text-center"> --}}
            {{-- <h2 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di Dashboard Eksekutif Sumber Daya Informasi</h2> --}}
            <h2 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang </h2>
            <p class="text-xl md:text-2xl mb-8">Platform monitoring data publikasi media cetak dan elektronik di Kota
                Surakarta</p>
            <div class="flex justify-center">
                <div id="landing-tabs" class="bg-white rounded-lg p-1 inline-flex" role="tablist" aria-label="Landing tabs">
                    <button type="button" data-target="view-kalender-publikasi" aria-selected="false"
                        class="tab-btn px-6 py-3 bg-white text-orange-600 rounded-lg font-semibold">Kalender
                        Publikasi</button>
                    <button type="button" data-target="view-kalender-baliho" aria-selected="true"
                        class="tab-btn ml-3 px-6 py-3 bg-orange-600 text-white rounded-lg font-semibold">Kalender
                        Baliho</button>
                    <button type="button" data-target="peta" aria-selected="false"
                        class="tab-btn ml-3 px-6 py-3 bg-white text-orange-600 rounded-lg font-semibold">Lihat Persebaran
                        Baliho</button>
                </div>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-7xl p-6 space-y-12 mb-6">

        <section id="view-kalender-baliho" class="relative bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="section-loader hidden absolute inset-0 z-20 items-center justify-center bg-white/80 backdrop-blur-sm">
                <div class="rounded-full bg-orange-600 px-4 py-2 text-sm font-semibold text-white shadow">Memuat...</div>
            </div>
            <div class="relative z-10">
                {{-- <div class="px-6 py-8 border-b border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900">Kalender Publikasi</h3>
                    <p class="text-gray-600 mt-2">Pantau jadwal publikasi media cetak dan elektronik dengan mudah dalam satu tampilan.</p>
                </div> --}}
                <livewire:kalender-baliho />
            </div>
        </section>
        <section id="view-kalender-publikasi" class="relative bg-white rounded-3xl shadow-xl overflow-hidden hidden">
            <div class="section-loader hidden absolute inset-0 z-20 items-center justify-center bg-white/80 backdrop-blur-sm">
                <div class="rounded-full bg-orange-600 px-4 py-2 text-sm font-semibold text-white shadow">Memuat...</div>
            </div>
            <div class="relative z-10">
                {{-- <div class="px-6 py-8 border-b border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900">Kalender Publikasi</h3>
                    <p class="text-gray-600 mt-2">Pantau jadwal publikasi media cetak dan elektronik dengan mudah dalam satu tampilan.</p>
                </div> --}}
                <livewire:kalender-publikasi />
            </div>
        </section>
        <section id="peta" class="relative bg-white rounded-3xl shadow-xl overflow-hidden hidden">
            <div class="section-loader hidden absolute inset-0 z-20 items-center justify-center bg-white/80 backdrop-blur-sm">
                <div class="rounded-full bg-orange-600 px-4 py-2 text-sm font-semibold text-white shadow">Memuat...</div>
            </div>
            <div class="relative z-10">
                {{-- <div class="px-6 py-8 border-b border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900">Peta Baliho</h3>
                    <p class="text-gray-600 mt-2">Lihat posisi baliho di Surakarta dan temukan informasi publikasi secara interaktif.</p>
                </div> --}}
                <livewire:public-baliho-map />
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('#landing-tabs .tab-btn');
            const sections = {
                'view-kalender-publikasi': document.getElementById('view-kalender-publikasi'),
                'view-kalender-baliho': document.getElementById('view-kalender-baliho'),
                'peta': document.getElementById('peta'),
            };
            const loaderTimers = {};

            function showLoader(target) {
                const section = sections[target];
                if (!section) return;
                const loader = section.querySelector('.section-loader');
                if (loader) {
                    loader.classList.remove('hidden');
                    loader.classList.add('flex');
                }
                if (loaderTimers[target]) {
                    clearTimeout(loaderTimers[target]);
                }
                loaderTimers[target] = setTimeout(() => hideLoader(target), 4000);
            }

            function hideLoader(target) {
                const section = sections[target];
                if (!section) return;
                const loader = section.querySelector('.section-loader');
                if (loader) {
                    loader.classList.add('hidden');
                    loader.classList.remove('flex');
                }
                if (loaderTimers[target]) {
                    clearTimeout(loaderTimers[target]);
                    delete loaderTimers[target];
                }
            }

            function activate(target) {
                tabs.forEach(btn => {
                    if (btn.dataset.target === target) {
                        btn.classList.remove('bg-white', 'text-orange-600');
                        btn.classList.add('bg-orange-600', 'text-white');
                        btn.setAttribute('aria-selected', 'true');
                    } else {
                        btn.classList.remove('bg-orange-600', 'text-white');
                        btn.classList.add('bg-white', 'text-orange-600');
                        btn.setAttribute('aria-selected', 'false');
                    }
                });

                Object.keys(sections).forEach(key => {
                    const el = sections[key];
                    if (!el) return;
                    if (key === target) el.classList.remove('hidden');
                    else el.classList.add('hidden');
                });

                showLoader(target);

                if (window.Livewire && typeof Livewire.dispatch === 'function') {
                    if (target === 'view-kalender-publikasi') Livewire.dispatch('refresh-kalender-publikasi');
                    if (target === 'view-kalender-baliho') Livewire.dispatch('refresh-kalender-baliho');
                    if (target === 'peta') {
                        Livewire.dispatch('refresh-public-baliho-map');
                        Livewire.dispatch('refresh-public-baliho-map');
                    }
                }
            }

            tabs.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.dataset.target;
                    activate(target);
                });
            });

            if (window.Livewire && typeof Livewire.on === 'function') {
                Livewire.on('update-markers', () => hideLoader('peta'));
                Livewire.on('refresh-calendar', () => {
                    hideLoader('view-kalender-baliho');
                    hideLoader('view-kalender-publikasi');
                });
            }
        });
    </script>

    {{-- <div class="text-dark py-8"> --}}
@endsection
