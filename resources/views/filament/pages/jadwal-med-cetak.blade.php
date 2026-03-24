<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Card Filter --}}
        <x-filament::section>
            <x-slot name="heading">Filter Kegiatan</x-slot>
            <x-filament::input.wrapper>
                <x-filament::input.select wire:model.live="selectedTrack">
                    <option value="">Semua Kegiatan</option>
                    @foreach($this->getTracks() as $id => $nama)
                        <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </x-filament::input.select>
            </x-filament::input.wrapper>
        </x-filament::section>

        {{-- Card Kalender --}}
        <x-filament::section>
            <x-slot name="heading">Kalender Monitoring</x-slot>
            <div class="mt-4">
                {{-- @livewire(\App\Filament\Widgets\JadwalBaliho::class, [
                    'selectedTrack' => $selectedTrack,
                ], key($selectedTrack . str()->random())) --}}
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>