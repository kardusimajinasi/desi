<?php

namespace App\Livewire;

use App\Models\PermohonanDetMedKomCetak;
use Livewire\Component;
use Illuminate\Support\Carbon;

class KalenderPublikasi extends Component
{


    public $selectedTrack = '';
    public $selectedEventDetails = '';
    public $events = [];

    public function mount()
    {
        $this->getEvents();
    }

    public function getEvents()
    {
        // Logika query data Anda
        return PermohonanDetMedKomCetak::query()
            // $this->events =  PermohonanDetMedKomCetak::query()
            ->when($this->selectedTrack, fn($query) => $query->where('kegiatan_id', $this->selectedTrack))
            ->get()
            // ->map(fn($record) => [
            //     'id'    => $record->id,
            //     'title' => $record->isi_konten,
            //     'start' => Carbon::parse($record->tgl_mulai_publikasi)->format('Y-m-d'),
            //     'end'   => Carbon::parse($record->tgl_selesai_publikasi)->addDay()->format('Y-m-d'),
            //     'url'   => url("admin/permohonan-det-med-kom-cetaks/{$record->id}/edit"),
            // ])->toArray();
            ->map(function (PermohonanDetMedKomCetak $record) {
                $isi_konten = strlen($record->isi_konten) > 50
                    ? substr($record->isi_konten, 0, 50) . '...'
                    : $record->isi_konten;
                $kegiatan = $record->kegiatan ? $record->kegiatan->nama : 'Kegiatan Unknown';
                $titik = $record->titikBaliho ? ' - ' . $record->titikBaliho->nama : '';

                $kegiatanId = $record->kegiatan_id;
                $color = match ($kegiatanId) {
                    // Baliho
                    'bd7e01de-430d-4336-8774-ed70142171d9' => [
                        '#ca8a04' // Kuning/Emas
                    ],
                    // Flyer
                    '9e9e8cf5-d669-4088-bf31-94fdce52779c' => [
                        '#16a34a' // Hijau
                    ],
                    // Spanduk
                    'e32537d5-e045-4762-9f8a-70880b52d0bd' => [
                        '#2563eb' // Biru
                    ],
                    // Tabloid
                    'cd6d6a81-e472-480b-8bf4-7144c0e75ed7' => [
                        '#e11d48' // Merah
                    ],
                    // Default jika tidak cocok
                    default => [
                        '#6b7280' // Abu-abu
                    ],
                };
                return [
                    'id'    => $record->id, // Sangat disarankan ada
                    'title' => $isi_konten . " ({$kegiatan})" . $titik,
                    'start' => Carbon::parse($record->tgl_mulai_publikasi)->format('Y-m-d'),
                    'end'   => Carbon::parse($record->tgl_selesai_publikasi)->addDay()->format('Y-m-d'),
                    'color' => $color, // Aktifkan warna agar terlihat jelas
                    'url' => null, // Tambahkan ini untuk filter
                    // 'url'   => url("admin/permohonan-det-med-kom-cetaks/{$record->id}/edit"),
                    // 'shouldOpenUrlInNewTab' => true, // Buka di tab baru'allDay' => true, // Tambahkan ini agar event memenuhi kotak tanggal
                ];
            })
            ->values() // Reset index array
            ->toArray();
    }

    public function showEventDetail($id)
    {
        $this->selectedEventDetails = PermohonanDetMedKomCetak::with(['kegiatan', 'titikBaliho'])->find($id);
        
        // Dispatch event untuk membuka modal di sisi browser
        $this->dispatch('open-modal-kalender', id: 'event-detail-modal');
    }

    public function updatedSelectedTrack()
    {
        $this->dispatch('refresh-calendar', events: $this->getEvents());
    }

    public function render()
    {
        return view('livewire.kalender-publikasi', [
            'events' => $this->getEvents(),
        ]);
    }
}
