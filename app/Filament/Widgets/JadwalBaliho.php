<?php

namespace App\Filament\Widgets;

use App\Models\Kegiatan;
use App\Models\PermohonanDetMedKomCetak;
use App\Models\PermohonanDetMedKomElektronik;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Contracts\View\View;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class JadwalBaliho extends FullCalendarWidget
{
    // protected int | string | array $columnSpan = [
    //     'md' => 2, // Mengambil 2 kolom pada layar medium ke atas
    //     'xl' => 2,
    // ];
    protected static ?int $sort = 6;

    // protected static ?string $heading = 'Jadwal Publikasi Media Cetak';
    protected int | string | array $columnSpan = 'full';
    // public function renderHeader(): View
    // {
    //     return view('filament.widgets.calendar-header');
    // }
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.widgets.calendar-header');
    }
    public $selectedTrack = '';

    public function fetchEvents(array $fetchInfo): array
    {
        // $cek = PermohonanDetMedKomCetak::query()
        //     ->when($this->selectedTrack, fn($query) => $query->where('kegiatan_id', $this->selectedTrack))
        //     ->with(['kegiatan', 'titikBaliho']) // Tambahkan Eager Loading agar nama titik muncul
        //     ->where('tgl_mulai_publikasi', '<=', $fetchInfo['end'])
        //     ->where('tgl_selesai_publikasi', '>=', $fetchInfo['start'])
        //     ->get()
        //     ->map(function (PermohonanDetMedKomCetak $record) {
        //         $isi_konten = strlen($record->isi_konten) > 50
        //             ? substr($record->isi_konten, 0, 50) . '...'
        //             : $record->isi_konten;
        //         $kegiatan = $record->kegiatan ? $record->kegiatan->nama : 'Kegiatan Unknown';
        //         $titik = $record->titikBaliho ? ' - ' . $record->titikBaliho->nama : '';
        //         return [
        //             'id'    => $record->id, // Sangat disarankan ada
        //             'title' => $isi_konten . " ({$kegiatan})" . $titik,
        //             'start' => SupportCarbon::make($record->tgl_mulai_publikasi)->format('Y-m-d'),
        //             'end'   => SupportCarbon::make($record->tgl_selesai_publikasi)->format('Y-m-d'),
        //             'color' => '#e11d48', // Aktifkan warna agar terlihat jelas
        //             'url'   => url("admin/permohonan-det-med-kom-cetaks/{$record->id}/edit"),
        //             'shouldOpenUrlInNewTab' => true, // Buka di tab baru
        //             'allDay' => true, // Tambahkan ini agar event memenuhi kotak tanggal
        //         ];
        //     })
        //     ->values() // Reset index array
        //     ->toArray();
        // // dd($cek);

        $cetakEvents = PermohonanDetMedKomCetak::query()
            ->when($this->selectedTrack, fn($query) => $query->where('kegiatan_id', $this->selectedTrack))
            ->with(['kegiatan', 'titikBaliho']) // Tambahkan Eager Loading agar nama titik muncul
            ->where('tgl_mulai_publikasi', '<=', $fetchInfo['end'])
            ->where('tgl_selesai_publikasi', '>=', $fetchInfo['start'])
            ->get()
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
                    'start' => SupportCarbon::make($record->tgl_mulai_publikasi)->format('Y-m-d'),
                    'end'   => SupportCarbon::make($record->tgl_selesai_publikasi)->format('Y-m-d'),
                    'color' => $color, // Aktifkan warna agar terlihat jelas
                    'url'   => url("admin/permohonan-det-med-kom-cetaks/{$record->id}/edit"),
                    'shouldOpenUrlInNewTab' => true, // Buka di tab baru'allDay' => true, // Tambahkan ini agar event memenuhi kotak tanggal
                ];
            });

        $elektronikEvents = PermohonanDetMedKomElektronik::query()
            ->when($this->selectedTrack, fn($query) => $query->where('kegiatan_id', $this->selectedTrack))
            ->get()
            // ->map(fn($record) => [
            //     'id'    => $record->id,
            //     'title' => $record->isi_konten,
            //     'start' => Carbon::parse($record->tgl_mulai_publikasi)->format('Y-m-d'),
            //     'end'   => Carbon::parse($record->tgl_selesai_publikasi)->addDay()->format('Y-m-d'),
            //     'url'   => url("admin/permohonan-det-med-kom-cetaks/{$record->id}/edit"),
            // ])->toArray();
            ->map(function (PermohonanDetMedKomElektronik $record) {
                $isi_konten = strlen($record->isi_konten) > 50
                    ? substr($record->isi_konten, 0, 50) . '...'
                    : $record->isi_konten;
                $kegiatan = $record->kegiatan ? $record->kegiatan->nama : 'Kegiatan Unknown';
                $titik = $record->titikBaliho ? ' - ' . $record->titikBaliho->nama : '';

                $kegiatanId = $record->kegiatan_id;
                $color = match ($kegiatanId) {

                    // Running Text
                    '76a8d937-6879-4f36-91af-4bef7c8771ce' => [
                        '#9333ea' // Ungu
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
            });

        return collect($cetakEvents)->merge($elektronikEvents)->values()->toArray();
    }

    /**
     * Opsional: Mengatur tampilan default kalender
     */
    public function config(): array
    {
        return [
            'initialView' => 'dayGridMonth', // Tampilan bulanan
            'headerToolbar' => [
                'left'   => 'prev,next today',
                'center' => 'title',
                'right'  => 'dayGridMonth,timeGridWeek',
            ],
        ];
    }

    // public function getTracks(): array
    // {
    //     return Kegiatan::pluck('nama', 'id')
    //         ->where('layanan_id', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1')
    //         ->toArray();
    // }
}
