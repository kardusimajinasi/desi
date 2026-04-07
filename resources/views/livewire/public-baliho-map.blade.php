<div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
    {{-- Load Leaflet CSS --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" /> --}}

    {{-- Load Leaflet JS --}}
    {{-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> --}}
    <div class="flex flex-col lg:flex-row gap-6">

        {{-- KIRI: PETA --}}
        <div class="w-full lg:w-2/4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Monitoring Sebaran Baliho</h2>
                <input type="date" wire:model.live="filterMapDate" class="border-gray-300 rounded-lg text-sm">
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
                <div id="map" wire:ignore style="height: 450px;" class="rounded-xl border shadow-inner z-10"></div>

            </div>

            <div class="mt-2 flex gap-4 text-[14px] uppercase tracking-wider text-gray-400 justify-start">

                {{-- <div class="mt-2 flex gap-4 text-[10px] uppercase font-bold text-gray-500"> --}}
                <span><span style="color: #3b82f6" class="text-blue-600">●</span> Marker Biru: Terisi</span>
                <span><span style="color: #10b981" class="text-green-600">●</span> Marker Hijau: Kosong</span>

            </div>
        </div>

        {{-- KANAN: TABEL --}}
        <div class="w-full lg:w-2/4 overflow-y-auto" style="height: 500px;">
            <div class="border rounded-xl shadow-sm overflow-hidden flex flex-col" style="height: 500px;">
                <div class="overflow-y-auto grow bg-white ">
                    <table class="w-full text-left text-md">
                        <thead class="sticky top-0 bg-gray-50 border-b ">
                            <tr>
                                <th class="px-3 py-2 font-semibold">Baliho</th>
                                <th class="px-3 py-2 font-semibold">Mulai</th>
                                <th class="px-3 py-2 font-semibold">Selesai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y ">
                            @foreach ($initialMarkers as $marker)
                                <tr class="transition-colors duration-200 hover:bg-gray-100/50  cursor-pointer">
                                    <td class="px-3 py-2 text-md font-medium bg-transparent">
                                        {{-- Tambahkan bg-transparent --}}
                                        @if (($marker['status'] ?? '') === 'Terisi')
                                            <span class="text-success-600 font-bold uppercase line-clamp-1">
                                                {{ $marker['konten'] }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 font-bold text-xs uppercase">-</span>
                                        @endif
                                        <span class="block text-gray-500 text-[12px] mt-0.5">
                                            {{ $marker['nama'] ?? 'Tanpa Nama' }}
                                        </span>
                                    </td>

                                    @if (($marker['status'] ?? '') === 'Terisi')
                                        <td class="px-3 py-2  text-gray-600  whitespace-nowrap">
                                            {{ $marker['tgl_mulai_publikasi'] ?? '-' }}
                                        </td>
                                        <td class="px-3 py-2  text-gray-600  whitespace-nowrap">
                                            {{ $marker['tgl_selesai_publikasi'] ?? '-' }}
                                        </td>
                                    @else
                                        <td colspan="2" class="px-3 py-2 text-center  text-gray-400 italic">
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
                                `${data.nama}<br><span class="font-bold ${data.status === 'Terisi' ? 'text-blue-500' : 'text-green-500'}">${data.status}</span>`, {
                                    direction: 'top',
                                    offset: [0, -10]
                                })
                            .bindPopup(`
                    <div style="min-width: 250px; font-family: 'Arial', sans-serif;">
                        <h3 style="margin: 0 0 8px 0; font-size: 16px; font-weight: bold; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 8px;">
                            ${data.nama}
                        </h3>
                        <div style="margin-bottom: 10px;">
                            <span style="font-size: 12px; color: #666; display: block;">Publikasi:</span>
                            <strong style="font-size: 14px; color: ${data.status === 'Terisi' ? '#1e40af' : '#e11d48'};">
                                ${data.konten}
                            </strong>
                        </div>
                        <div style="font-size: 12px; line-height: 1.5; color: #444;">
                            <p style="margin: 0 0 5px 0;">${data.alamat || 'Alamat tidak tersedia'}</p>
                            <p style="margin: 0;"><strong>Ukuran:</strong> ${data.ukuran}</p>
                        </div>
                    </div>
                `);

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
