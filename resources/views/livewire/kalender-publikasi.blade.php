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
        {{-- Loading Overlay --}}
        {{-- <div wire:loading.delay.longer wire:target="selectedTrack"
            class="absolute inset-0 z-50 flex items-center justify-center bg-white/50 backdrop-blur-[1px]">
            <p class="font-bold">Memuat...</p>
        </div> --}}

        {{-- Container Kalender --}}
        <div class="relative">
            <div id="calendar-canvas" wire:ignore class="min-h-[600px]"></div>
        </div>

        {{-- Modal Detail --}}
        <div x-data="{ open: false }" x-on:open-modal-kalender.window="open = true"
            x-on:close-modal-kalender.window="open = false" x-show="open" class="fixed inset-0 z-[9999] overflow-y-auto"
            style="display: none;">

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
                                                $fileExists = $doc->lokasi_file
                                                    && \Illuminate\Support\Facades\Storage::disk('local')->exists($doc->lokasi_file);
                                                $fileUrl = $fileExists
                                                    ? route('dokumentasi-medkom.show', [
                                                        'documentation' => $doc,
                                                        'filename' => basename($doc->lokasi_file),
                                                    ])
                                                    : null;
                                            @endphp

                                            <div class="group relative">
                                                <div
                                                    class="w-24 h-24 rounded-lg overflow-hidden border border-gray-200 shadow-sm transition-all group-hover:ring-2 group-hover:ring-primary-500">
                                                    @if ($fileUrl)
                                                        <a href="{{ $fileUrl }}" target="_blank"
                                                            class="absolute inset-0 z-10">
                                                        </a>
                                                        <img src="{{ $fileUrl }}" alt="Dokumentasi"
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


        {{-- Load Library & Script --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script> --}}

        @script
            <script>
                const calendarEl = document.getElementById('calendar-canvas');

                // Inisialisasi FullCalendar
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'id',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek'
                    },
                    buttonText: {
                        today: 'hari ini',
                        week: 'Minggu',
                        month: 'Bulan',
                    },
                    // Mengambil data awal dari fungsi PHP getEvents()
                    events: @js($this->getEvents()),
                    eventClick: function(info) {
                        // Contoh aksi saat event diklik
                        // Mencegah navigasi URL default jika ada
                        info.jsEvent.preventDefault();

                        // Panggil fungsi di Livewire menggunakan ID dari event
                        $wire.showEventDetail(info.event.id);
                    }
                });

                calendar.render();

                // Menangkap signal 'refresh-calendar' dari Livewire
                $wire.on('refresh-calendar', (data) => {
                    calendar.removeAllEvents();
                    calendar.addEventSource(data.events);
                });
            </script>
        @endscript
    </div>

    @script

    @endscript
</div>

 