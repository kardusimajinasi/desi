<x-filament-widgets::widget>
    <x-filament::section>
        <div class="relative grid place-items-center w-full h-full min-h-[400px]">

            <div wire:loading wire:target="selectedTrack"
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

            <div class="flex items-center justify-between mb-4 pb-4 border-b">
                <h2 class="text-lg font-bold tracking-tight">Jadwal Publikasi Media Cetak & Elektronik</h2>

                <div class="flex items-center gap-2">
                    <label class="text-sm font-medium">Kategori:</label>
                    <select wire:model.live="selectedTrack"
                        class="rounded-lg border-gray-300 text-sm shadow-sm dark:bg-gray-800 dark:text-white">
                        <option value="">Semua Kegiatan</option>
                        @foreach (\App\Models\Kegiatan::where('layanan_id', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1')->pluck('nama', 'id') as $id => $nama)
                            <option value="{{ $id }}">{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Gunakan key unik agar kalender dipaksa render ulang saat filter berubah --}}
            <div wire:key="calendar-{{ $selectedTrack }}">
                @include('filament-fullcalendar::fullcalendar')
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
