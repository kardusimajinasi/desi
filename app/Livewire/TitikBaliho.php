<?php

namespace App\Livewire;

use App\Models\TitikBaliho as ModelsTitikBaliho;
use Carbon\Carbon;

use Livewire\Component;

class TitikBaliho extends Component
{
    public $filterSearchTitikBaliho;
    public $selectedMedia;

    public function mount()
    {
        $this->filterSearchTitikBaliho = null;
        // $this->filterSearchTitikBaliho = Carbon::create(2026, 3, 25)->toDateString();
    }

    public function updatedfilterSearchTitikBaliho()
    {
        $latestMarkers = $this->getMarkersDataProperty();

        // Kirim data terbaru ke JavaScript
        $this->dispatch('update-markers', $latestMarkers);
    }
    public function getMarkersDataProperty()
    {
        $search = $this->filterSearchTitikBaliho;
        return ModelsTitikBaliho::with(['ukuranBaliho'])
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('nama', 'like', '%' . $search . '%')
                        ->orWhere('alamat', 'like', '%' . $search . '%');
                });
            })
            ->get()

            ->sortBy('nama')
            ->map(function ($record) {
                $publikasiAktif = $record->permohonanDetMedKomCetak->first();
                return [
                    'id' => $record->id,
                    'lat' => (float) $record->lat,
                    'lng' => (float) $record->lng,
                    'nama' => $record->nama,
                    'alamat' => $record->alamat,
                    'layout' => $record->ukuranBaliho?->layout ?? '-',
                    'ukuran' => $record->ukuranBaliho ? "{$record->ukuranBaliho->ukuran_panjang}x{$record->ukuranBaliho->ukuran_lebar} m" : '-',
                    'titik_lokasi' => $record->titik_lokasi,
                    'foto_baliho' => $record->foto_baliho,
                ];
            })
            ->values()
            ->toArray() ?? [];
    }

    public function viewFotoAction($foto_baliho)
    {
        $this->selectedMedia = $foto_baliho;

        $this->dispatch('open-modal-media');
    }

    public function render()
    {

        $initialMarkers = $this->getMarkersDataProperty();
        // dd($initialMarkers, $initialMarkerss);
        // \Log::info('Rendering with markers', ['count' => count($markers)]);
        return view('livewire.titik-baliho', [
            'initialMarkers' => $initialMarkers,

        ]);
    }
}
