<?php

namespace App\Livewire;

use App\Models\TitikBaliho;
use Livewire\Component;
use Illuminate\Support\Carbon;

class PublicBalihoMap extends Component
{
    public $filterMapDate;
    protected $listeners = [
        'refresh-public-baliho-map' => 'onRefreshFromTab',
    ];

    public function mount()
    {
        $this->filterMapDate = Carbon::now()->toDateString();
        // $this->filterMapDate = Carbon::create(2026, 3, 25)->toDateString();
    }

    public function updatedFilterMapDate()
    {
        $latestMarkers = $this->getMarkersDataProperty();

        // Kirim data terbaru ke JavaScript
        $this->dispatch('update-markers', $latestMarkers);
    }

    public function onRefreshFromTab()
    {
        $latestMarkers = $this->getMarkersDataProperty();
        // dd($latestMarkers);
        $this->dispatch('update-markers', $latestMarkers);
    }
    public function getMarkersDataProperty()
    {
        $selectedDate = $this->filterMapDate ?: Carbon::today()->toDateString();
        return TitikBaliho::with(['ukuranBaliho', 'permohonanDetMedKomCetak' => function ($query) use ($selectedDate) {
            $query->where('tgl_mulai_publikasi', '<=', $selectedDate)
                ->where('tgl_selesai_publikasi', '>=', $selectedDate)
                ->limit(1);
        }])
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->get()

            ->sortByDesc(function ($titik) {
                return $titik->permohonanDetMedKomCetak->first()?->tgl_mulai_publikasi;
            })
            ->map(function ($record) {
                $publikasiAktif = $record->permohonanDetMedKomCetak->first();
                return [
                    'id' => $record->id,
                    'lat' => (float) $record->lat,
                    'lng' => (float) $record->lng,
                    'tgl_mulai_publikasi' => $publikasiAktif ? Carbon::parse($publikasiAktif->tgl_mulai_publikasi)->format('d M Y') : '',
                    'tgl_selesai_publikasi' => $publikasiAktif ? Carbon::parse($publikasiAktif->tgl_selesai_publikasi)->format('d M Y') : '',
                    'nama' => $record->nama,
                    'konten' => $publikasiAktif ? strtoupper($publikasiAktif->isi_konten) : 'KOSONG',
                    'status' => $publikasiAktif ? 'Terisi' : 'Tersedia',
                    'warna' => $publikasiAktif ? '#3b82f6' : '#10b981', // Biru vs Hijau
                    'alamat' => $record->alamat,
                    'ukuran' => $record->ukuranBaliho ? "{$record->ukuranBaliho->ukuran_panjang}x{$record->ukuranBaliho->ukuran_lebar} m" : '-',
                ];
            })
            ->values()
            ->toArray() ?? [];
    }

    public function render()
    {

        $initialMarkers = $this->getMarkersDataProperty();
        // dd($initialMarkers, $initialMarkerss);
        // \Log::info('Rendering with markers', ['count' => count($markers)]);
        return view('livewire.public-baliho-map', [
            'initialMarkers' => $initialMarkers,

        ]);
    }
}
