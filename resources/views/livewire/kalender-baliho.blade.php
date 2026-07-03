<div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
    {{-- Filter Dropdown --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">Kalender Publikasi</h2>
        {{-- <input type="date" wire:model.live="filterMapDate" class="border-gray-300 rounded-lg text-sm"> --}}
        <div>
            <span class="text-sm text-gray-500 italic">Kategori: </span>
            <select wire:model.live="selectedTrack" class="border-gray-300 rounded-lg text-sm">
                <option value="">Semua Kegiatan</option>
                @foreach (\App\Models\Kegiatan::all() as $kegiatan)
                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Container Kalender --}}
    <div class="relative">
        {{-- Filter and navigation --}}
        <div class="flex flex-col gap-4 mb-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex items-center gap-2">
                <button wire:click="previousMonth" type="button"
                    class="px-3 py-2 bg-gray-100 rounded border border-gray-200 hover:bg-gray-200">
                    ‹ Bulan Sebelumnya
                </button>
                <div class="text-lg font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($currentMonth . '-01')->isoFormat('MMMM YYYY') }}
                </div>
                <button wire:click="nextMonth" type="button"
                    class="px-3 py-2 bg-gray-100 rounded border border-gray-200 hover:bg-gray-200">
                    Bulan Berikutnya ›
                </button>
            </div>

            {{-- <div class="flex items-center gap-2">
                <label class="text-sm font-medium text-gray-600">Kategori:</label>
                <select wire:model="selectedTrack" class="border-gray-300 rounded-lg text-sm">
                    <option value="">Semua Kegiatan</option>
                    @foreach (\App\Models\Kegiatan::all() as $kegiatan)
                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }}</option>
                    @endforeach
                </select>
            </div> --}}
        </div>

        {{-- Grid Kalender --}}
        <div class="overflow-x-auto border border-gray-200 rounded-lg bg-white shadow-sm">
            <table class="w-full border-collapse table-fixed border border-gray-200" style="width:100%;">
                <thead class="bg-gray-50">
                    <tr>
                        <th width="7%" class="sticky left-0 z-30 border-r border-gray-200 bg-gray-50 px-4 py-3 text-left font-semibold text-gray-700" rowspan="2">Lokasi Baliho</th>
                        <th class="border-b border-gray-200 px-2 py-3 text-center text-base font-semibold text-gray-700" colspan="{{ count($days) }}">
                            {{ \Carbon\Carbon::parse($currentMonth . '-01')->isoFormat('MMMM YYYY') }}
                        </th>
                    </tr>
                    <tr>
                        {{-- <th class="sticky left-0 z-20 border-r border-gray-200 bg-gray-50"></th> --}}
                        @foreach ($days as $day)
                            <th width="2%" class="border-l border-b border-gray-200 bg-gray-50 px-2 py-3 text-center text-[11px] font-semibold text-gray-600">
                                <div>{{ $day['day'] }}</div>
                                <div class="text-[10px] text-gray-500">{{ $day['weekday'] }}</div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach (collect($resources)->groupBy('ukuran_baliho') as $ukuran => $groupResources)
                        <tr class="bg-gray-100">
                            <td class="sticky left-0 z-20 border-r border-gray-200 bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700"">
                                Ukuran: {{ $ukuran }}
                            </td>
                            <td class=" left-0 z-20 border-r border-gray-200 bg-gray-100 px-4 py-2 text-sm font-semibold text-gray-700" colspan="{{ count($days) }}">
                                &nbsp;
                            </td>
                           
                        </tr>
                        @foreach ($groupResources as $resource)
                            @foreach ($resource['lanes'] as $laneIndex => $lane)
                                <tr class="border-t border-gray-200">
                                    <td class="sticky left-0 z-10 border-r border-gray-200 bg-white px-4 py-3 align-top">
                                        @if ($laneIndex === 0)
                                            <div class="font-xs text-gray-800">{{ $resource['title'] }}</div>
                                            <div class="text-xs text-gray-500">{{ $resource['alamat'] }}</div>
                                        @endif
                                    </td>
                                    @php
                                        $dayIndex = 1;
                                    @endphp
                                    @while ($dayIndex <= count($days))
                                        @php
                                            $event = collect($lane)->first(function($item) use ($dayIndex) {
                                                return isset($item['startIndex']) && $item['startIndex'] === $dayIndex;
                                            });
                                        @endphp
                                        @if ($event)
                                            <td class="border border-gray-200 bg-slate-50 px-1 py-2 align-top" colspan="{{ $event['span'] }}">
                                                <button type="button"
                                                    wire:click.prevent="showEventDetail('{{ $event['id'] }}')"
                                                    class="w-full rounded text-white text-xs text-left px-2 py-1 shadow-sm overflow-hidden" style="background-color: {{ $event['color'] }};">
                                                    {{ $event['title'] }}
                                                </button>
                                            </td>
                                            @php $dayIndex += $event['span']; @endphp
                                        @else
                                            <td class="border border-gray-200 bg-white px-1 py-3"></td>
                                            @php $dayIndex++; @endphp
                                        @endif
                                    @endwhile
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal Detail --}}
        <div x-data="{ open: false }" x-on:open-modal-kalender.window="open = true"
            x-on:close-modal-kalender.window="open = false" x-show="open"
            class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;">

            <div class="fixed inset-0 bg-black opacity-50"></div>

            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white p-6 rounded-lg max-w-lg w-full shadow-xl text-gray-900">

                    <h2 class="text-lg font-bold text-gray-900">Detail Jadwal Publikasi</h2>

                    <div class="bg-white p-6 rounded-lg text-gray-900">
                        @if ($selectedEventDetails)
                            <div class="space-y-1">
                                <div class="grid grid-cols-3 gap-4 border-b pb-2">
                                    <span class="font-bold text-gray-600">Kegiatan:</span>
                                    <span
                                        class="col-span-2 font-medium">{{ $selectedEventDetails->kegiatan->nama ?? '-' }}</span>
                                </div>

                                <div class="grid grid-cols-3 gap-4 border-b pb-2">
                                    <span class="font-bold text-gray-600">Isi Konten:</span>
                                    <span class="col-span-2">{{ $selectedEventDetails->isi_konten }}</span>
                                </div>

                                <div class="grid grid-cols-3 gap-4 border-b pb-2">
                                    <span class="font-bold text-gray-600">Lokasi:</span>
                                    <span
                                        class="col-span-2">{{ $selectedEventDetails->titikBaliho->nama ?? '-' }}</span>
                                </div>

                                <div class="grid grid-cols-3 gap-4">
                                    <span class="font-bold text-gray-600">Periode:</span>
                                    <span class="col-span-2 text-primary-600 font-bold">
                                        {{ \Carbon\Carbon::parse($selectedEventDetails->tgl_mulai_publikasi)->format('d M Y') }}
                                        s/d
                                        {{ \Carbon\Carbon::parse($selectedEventDetails->tgl_selesai_publikasi)->format('d M Y') }}
                                    </span>
                                </div>

                                {{-- Section Dokumentasi Tanpa Tabel Tambahan --}}
                                <div class="mt-6 pt-4 border-t border-gray-100">
                                    <div
                                        class="text-xs font-bold uppercase tracking-widest text-gray-400 flex items-center gap-2 mb-4">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Lampiran Dokumentasi
                                    </div>

                                    <div class="flex flex-wrap gap-3">
                                        @forelse($selectedEventDetails->dokumentasi as $doc)
                                            @php
                                                $path = storage_path('app/private/' . $doc->lokasi_file);
                                                $base64 = file_exists($path)
                                                    ? 'data:image/' .
                                                        pathinfo($path, PATHINFO_EXTENSION) .
                                                        ';base64,' .
                                                        base64_encode(file_get_contents($path))
                                                    : null;
                                            @endphp

                                            <div class="group relative">
                                                <div
                                                    class="w-24 h-24 rounded-lg overflow-hidden border border-gray-200 shadow-sm transition-all group-hover:ring-2 group-hover:ring-primary-500">
                                                    @if ($base64)
                                                        <a href="{{ $base64 }}" target="_blank"
                                                            class="absolute inset-0 z-10">
                                                        </a>
                                                        <img src="{{ $base64 }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div
                                                            class="w-full h-full bg-gray-50 flex items-center justify-center text-[10px] text-gray-400 text-center p-2">
                                                            Kosong
                                                        </div>
                                                    @endif
                                                </div>
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-[9px] p-1 translate-y-full opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all rounded-b-lg text-center">
                                                    {{ $doc->jenis }}
                                                </div>
                                            </div>
                                        @empty
                                            <div class="w-full text-sm text-gray-400 italic py-2">Belum ada foto
                                                dokumentasi.</div>
                                        @endforelse
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="p-4 text-center text-gray-500 italic">Memuat data detail...</div>
                        @endif
                    </div>

                    <button x-on:click="open = false" class="mt-4 px-4 py-2 bg-gray-200 rounded">Tutup</button>
                </div>
            </div>
        </div>


        {{-- Tidak memakai FullCalendar --}}
    </div>
</div>
