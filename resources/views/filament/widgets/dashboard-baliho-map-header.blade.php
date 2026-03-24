<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Header & Filter --}}
        {{-- Grid Layout: Menggunakan 6 kolom untuk mencapai rasio 4:2 --}}
        {{-- Grid Container dengan Force Important --}}

        <div class="relative grid place-items-center w-full h-full min-h-[400px]">
            <div 
                wire:loading wire:target="filterDate"
                class="absolute inset-0 z-50 flex items-center justify-center w-48 bg-transparent">
                <div
                    class="flex flex-col items-center top-50 max-w-48 gap-2 bg-white dark:bg-gray-800 px-6 py-3 rounded-lg shadow-xl border dark:border-gray-700 backdrop-blur-md">
                    <div class="flex items-center gap-3">
                        <x-filament::loading-indicator class="h-5 w-5 text-primary-600" />
                        <span class="text-xs font-bold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Memuat Data...
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 w-full items-start">
                {{-- BAGIAN KIRI: Peta (66.6%) --}}
                <div class="w-full lg:w-[66.6%] flex-shrink-0">
                    <div class="flex items-center justify-between mb-4 pb-4 border-b dark:border-gray-700">
                        <div>
                            <h2 class="text-lg font-bold tracking-tight">Monitoring Sebaran Baliho</h2>
                            <p class="text-xs text-gray-500">Status titik pada tanggal yang dipilih</p>
                        </div>

                        <div class="flex items-center gap-2">
                            <x-filament::input.wrapper>
                                <input type="date" wire:model.live="filterDate"
                                    class="block w-full border-none py-1.5 text-sm ring-0 focus:ring-0 dark:bg-gray-800">
                            </x-filament::input.wrapper>
                        </div>
                    </div>
                    <div wire:key="map-container-{{ $filterDate }}" style="height: 400px;"
                        class="overflow-hidden rounded-xl border dark:border-gray-700 shadow-sm bg-gray-50">
                        @include('filament-maps::widgets.map')
                    </div>
                    <div class="mt-2 flex gap-4 text-[10px] uppercase tracking-wider text-gray-400 justify-start">
                        <span><span style="color: #3b82f6" class="text-blue-600">●</span> Marker Biru: Terisi</span>
                        <span><span style="color: #10b981" class="text-green-600">●</span> Marker Hijau: Kosong</span>
                    </div>

                </div>

                {{-- BAGIAN KANAN: Tabel (33.3%) --}}
                <div class="w-full lg:w-[33.3%] flex-shrink-0">
                    <div class="border dark:border-gray-700 rounded-xl shadow-sm overflow-hidden flex flex-col"
                        style="height: 500px;">
                        <div class="overflow-y-auto grow bg-white dark:bg-gray-900">
                            <table class="w-full text-left text-sm">
                                <thead class="sticky top-0 bg-gray-50 dark:bg-gray-800 border-b dark:border-gray-700">
                                    <tr>
                                        <th class="px-3 py-2 font-semibold">Baliho</th>
                                        <th class="px-3 py-2 font-semibold">Mulai</th>
                                        <th class="px-3 py-2 font-semibold">Selesai</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y dark:divide-gray-700">
                                    @foreach ($this->getTableData() as $marker)
                                        <tr
                                            class="transition-colors duration-200 hover:bg-gray-100/50 dark:hover:bg-gray-700/50 cursor-pointer">
                                            <td class="px-3 py-2 text-sm font-medium bg-transparent">
                                                {{-- Tambahkan bg-transparent --}}
                                                @if (($marker['status'] ?? '') === 'Terisi')
                                                    <span
                                                        class="text-success-600 font-bold text-[11px] uppercase line-clamp-1">
                                                        {{ $marker['konten'] }}
                                                    </span>
                                                @else
                                                    <span class="text-gray-400 font-bold text-xs uppercase">-</span>
                                                @endif
                                                <span class="block text-gray-500 text-[10px] mt-0.5">
                                                    {{ $marker['nama'] ?? 'Tanpa Nama' }}
                                                </span>
                                            </td>

                                            @if (($marker['status'] ?? '') === 'Terisi')
                                                <td
                                                    class="px-3 py-2 text-[10px] text-gray-600 dark:text-gray-400 whitespace-nowrap">
                                                    {{ $marker['tgl_mulai_publikasi'] ?? '-' }}
                                                </td>
                                                <td
                                                    class="px-3 py-2 text-[10px] text-gray-600 dark:text-gray-400 whitespace-nowrap">
                                                    {{ $marker['tgl_selesai_publikasi'] ?? '-' }}
                                                </td>
                                            @else
                                                <td colspan="2"
                                                    class="px-3 py-2 text-center text-[10px] text-gray-400 italic">
                                                    Tersedia
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
