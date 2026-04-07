<div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
    {{-- Load Leaflet CSS --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" /> --}}

    {{-- Load Leaflet JS --}}
    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> --}}
    {{-- <div class="flex flex-col lg:flex-row gap-6"> --}}

    {{-- KIRI: PETA --}}
    <div class="w-full ">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Peta titik baliho</h2>
            {{-- <input type="text" wire:model.live="filterSearchTitikBaliho" class="border-gray-300 rounded-lg text-sm"> --}}

            <div class="relative w-full max-w-xs">
                {{-- Ikon Pencarian (Opsional, menggunakan SVG Heroicons) --}}
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>

                {{-- Input Text Biasa --}}
                <input type="text" wire:model.live.debounce.500ms="filterSearchTitikBaliho"
                    placeholder="Cari nama atau alamat..."
                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-amber-500 focus:border-amber-500">
            </div>

        </div>

        <div class="relative">

            {{-- <div wire:loading wire:target="filterMapDatea"
                    class="absolute inset-0 z-[1000] flex items-center justify-center bg-white/50 backdrop-blur-[1px] rounded-xl">
                    <div class="flex items-center gap-3 bg-white px-6 py-3 rounded-lg shadow-xl border border-gray-200">
                        <x-filament::loading-indicator class="h-5 w-5 text-primary-600" />
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-wider">Memuat Data...</span>
                    </div>
                </div> --}}
            {{-- Container Peta --}}
            <div id="map" wire:ignore style="height: 350px;" class="rounded-xl border shadow-inner z-10"></div>

        </div>


    </div>

    {{-- </div> --}}
    <div class="overflow-x-auto bg-white rounded-xl mt-6 shadow-sm border border-gray-100">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Ukuran baliho</th>
                    <th class="px-6 py-4">Alamat</th>
                    <th class="px-6 py-4">Lihat Gambar baliho</th>
                    <th class="px-6 py-4">Lihat Lokasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($initialMarkers as $baliho)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-gray-900">{{ $baliho['nama'] }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 text-[10px] font-semibold rounded {{ $baliho['layout'] == 'vertical' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $baliho['layout'] }}
                            </span>
                            <div class="text-xs text-gray-500 mt-1">{{ $baliho['ukuran'] }}

                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ Str::limit($baliho['alamat'], 120) }}</td>

                        <td class="px-6 py-4">
                            <x-filament::link {{-- Perhatikan tanda kutip pada parameter foto_baliho --}}
                                wire:click="viewFotoAction('{{ $baliho['foto_baliho'] }}')" icon="heroicon-o-camera"
                                color="warning" class="cursor-pointer">
                                Lihat Gambar baliho
                            </x-filament::link>
                        </td>

                        {{-- Kolom Lihat Lokasi --}}
                        <td class="px-6 py-4">
                            @if ($baliho['titik_lokasi'])
                                <x-filament::link href="{{ $baliho['titik_lokasi'] }}" target="_blank"
                                    icon="heroicon-o-map-pin" color="success">
                                    Lihat Lokasi
                                </x-filament::link>
                            @else
                                <span class="text-gray-400 text-xs italic">Lokasi tidak ada</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <x-filament-actions::modals /> --}}
        <div x-data="{ open: false }" x-on:open-modal-media.window="open = true"
            x-on:close-modal-media.window="open = false" x-show="open" class="fixed inset-0 z-[9999] overflow-y-auto"
            style="display: none;">

            <div class="fixed inset-0 bg-black opacity-50"></div>

            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="bg-white p-6 rounded-lg max-w-lg w-full shadow-xl text-gray-900">

                    <h2 class="text-lg font-bold text-gray-900">Foto Baliho</h2>

                    <div class="bg-white p-1 rounded-lg text-gray-900">
                        @if ($selectedMedia)
                            <div class="space-y-1">

                                {{-- Section Dokumentasi Tanpa Tabel Tambahan --}}

                                <div class="flex flex-wrap gap-3">
                                    @php
                                        $path = storage_path('app/private/' . $selectedMedia);
                                        $base64 = file_exists($path)
                                            ? 'data:image/' .
                                                pathinfo($path, PATHINFO_EXTENSION) .
                                                ';base64,' .
                                                base64_encode(file_get_contents($path))
                                            : null;
                                    @endphp

                                    <div class="group relative">
                                        <div
                                            class="w-80 max-h-72 rounded-lg overflow-hidden border border-gray-200 shadow-sm transition-all group-hover:ring-2 group-hover:ring-primary-500">
                                            @if ($base64)
                                                <img src="{{ $base64 }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full bg-gray-50 flex items-center justify-center text-[10px] text-gray-400 text-center p-2">
                                                    Belum ada foto
                                                    dokumentasi.
                                                </div>
                                            @endif
                                        </div>
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
    </div>

    @script
        <script>
            let map, markers = [];
            /* ----------------------------- Initialize Map ----------------------------- */
            function initMap() {
                map = L.map('map', {
                    center: {
                        lat: -7.567034785878844,
                        lng: 110.79615167728225,

                    },
                    zoom: 13
                });

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Â© OpenStreetMap'
                }).addTo(map);

                map.on('click', mapClicked);
                initMarkers();
            }
            initMap();

            // SINKRONISASI: Jalankan ulang saat filterMapDate diubah di Livewire
            $wire.on('update-markers', (event) => {
                console.log('Filter dijalankan, menerima data baru...');

                // Di Livewire v3, data yang dikirim via dispatch ada di dalam array pertama atau property detail
                const newMarkers = Array.isArray(event) ? event[0] : event;

                initMarkers(newMarkers);
            });

            /* --------------------------- Initialize Markers --------------------------- */
            function initMarkers(newMarkers = null) {
                // 1. Tentukan sumber data
                const rawData = newMarkers ? newMarkers : <?php echo json_encode($initialMarkers); ?>;

                // Konversi ke Array jika data berupa Object (mengantisipasi Associative Array dari PHP)
                const dataToLoad = Array.isArray(rawData) ? rawData : Object.values(rawData);

                console.log('Rendering markers with:', dataToLoad);

                // 2. Bersihkan marker lama
                if (markers.length > 0) {
                    markers.forEach(marker => map.removeLayer(marker));
                    markers = [];
                }

                // 3. Gambar marker baru menggunakan dataToLoad yang sudah pasti Array
                dataToLoad.forEach((data, index) => {
                    if (data.lat && data.lng) {
                        const marker = generateMarker(data, index);

                        marker.addTo(map)
                            .bindTooltip(
                                `${data.nama}<br><span class="font-bold ${data.layout === 'Horizontal' ? 'text-blue-500' : 'text-green-500'}">${data.layout}</span>`, {
                                    direction: 'top',
                                    offset: [0, -10]
                                });

                        markers.push(marker);
                    }
                });

                // Zoom ke semua marker
                if (markers.length > 0) {
                    const group = new L.featureGroup(markers);
                    map.fitBounds(group.getBounds().pad(0.1));
                }
            }

            function generateMarker(data, index) {
                let color = 'blue'; // Default

                if (data.status === 'Tersedia') {
                    color = 'green';
                } else if (data.status === 'Terisi') {
                    color = 'blue';
                }


                const baseUrl = "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/";

                // 2. Buat Icon Standard dengan Shadow
                const customIcon = L.icon({
                    iconUrl: `${baseUrl}marker-icon-2x-${color}.png`,
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41], // Ukuran standar Leaflet
                    iconAnchor: [12, 41], // Ujung bawah pin pas di titik
                    popupAnchor: [1, -34], // Posisi popup di atas pin
                    shadowSize: [41, 41] // Ukuran bayangan
                });

                return L.marker([data.lat, data.lng], {
                    icon: customIcon
                }).on('click', (event) => markerClicked(event, index));

            }

            /* ------------------------- Handle Map Click Event ------------------------- */
            function mapClicked($event) {
                console.log(map);
                console.log($event.latlng.lat, $event.latlng.lng);
            }

            /* ------------------------ Handle Marker Click Event ----------------------- */
            function markerClicked($event, index) {
                console.log(map);
                console.log($event.latlng.lat, $event.latlng.lng);
            }

            /* ----------------------- Handle Marker DragEnd Event ---------------------- */
            function markerDragEnd($event, index) {
                console.log(map);
                console.log($event.target.getLatLng());
            }
        </script>
    @endscript
</div>
