<?php

namespace App\Livewire;

use App\Models\TitikBaliho;
use App\Models\PermohonanDetMedKomCetak;
use App\Models\PermohonanDetMedKomElektronik;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KalenderBaliho extends Component
{
    public $selectedTrack = '';
    public $selectedEventDetails = null;
    public $events = [];
    public $resources = [];
    public $days = [];
    public $currentMonth;

    public function mount()
    {
        $this->currentMonth = Carbon::now()->format('Y-m');
        $this->refreshCalendar();
    }

    protected $listeners = [
        'refresh-kalender-baliho' => 'refreshFromTab',
    ];

    public function previousMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth . '-01')->subMonth()->format('Y-m');
        $this->refreshCalendar();
    }

    public function nextMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth . '-01')->addMonth()->format('Y-m');
        $this->refreshCalendar();
    }

    public function refreshCalendar()
    {
        $calendarData = $this->getCalendarData();
        $this->events = $calendarData['events'];
        $this->resources = $calendarData['resources'];
        $this->days = $calendarData['days'];
    }

    public function refreshFromTab()
    {
        $this->refreshCalendar();
        $this->dispatch('refresh-calendar', events: $this->events, resources: $this->resources);
    }

    public function updatedSelectedTrack()
    {
        $this->refreshCalendar();
    }

    public function getCalendarData()
    {
        $monthStart = Carbon::parse($this->currentMonth . '-01')->startOfMonth();
        $monthEnd = $monthStart->copy()->endOfMonth();

        $days = [];
        $currentDate = $monthStart->copy();
        while ($currentDate->lte($monthEnd)) {
            $days[] = [
                'date' => $currentDate->format('Y-m-d'),
                'day' => $currentDate->format('d'),
                'weekday' => $currentDate->isoFormat('dd'),
            ];
            $currentDate->addDay();
        }

        // Filter events yang tumpang-tindih dengan bulan yang ditampilkan
        // menggunakan perbandingan tahun-bulan (Y-m), bukan tanggal penuh (Y-m-d)
        $selectedMonth = $monthStart->format('Y-m');
        $year = $monthStart->format('Y');  // Contoh: 2026
        $month = $monthStart->format('m'); // Contoh: 06

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate   = Carbon::create($year, $month, 1)->endOfMonth();
        // dd($selectedMonth);
        $records = PermohonanDetMedKomCetak::query()
            ->with(['kegiatan', 'titikBaliho'])
            ->when($this->selectedTrack, fn($query) => $query->where('kegiatan_id', $this->selectedTrack))
            // ->where(function ($query) use ($year, $month) {
            //     $query->where(function ($sub) use ($year, $month) {
            //         // Kondisi A: tgl_mulai_publikasi bernilai Y-m ini
            //         $sub->whereYear('tgl_mulai_publikasi', $year)
            //             ->whereMonth('tgl_mulai_publikasi', $month);
            //     })
            //         ->orWhere(function ($sub) use ($year, $month) {
            //             // Kondisi B: tgl_selesai_publikasi bernilai Y-m ini
            //             $sub->whereYear('tgl_selesai_publikasi', $year)
            //                 ->whereMonth('tgl_selesai_publikasi', $month);
            //         });
            // })
            ->whereDate('tgl_mulai_publikasi', '<=', $endDate)
            ->whereDate('tgl_selesai_publikasi', '>=', $startDate)
            ->where('kegiatan_id', 'bd7e01de-430d-4336-8774-ed70142171d9') // Filter untuk kegiatan Baliho
            ->orderBy('tgl_mulai_publikasi', 'asc')
            ->get();

        // dd($records);

        $events = $records->filter(fn($record) => $record->titikBaliho)->map(function (PermohonanDetMedKomCetak $record) use ($monthStart, $monthEnd, $days) {
            $content = trim($record->isi_konten ?: '');
            if ($content === '') {
                $content = $record->kegiatan?->nama ?? 'Publikasi Baliho';
            }
            $title = strlen($content) > 40 ? substr($content, 0, 40) . '...' : $content;


            $eventStart = Carbon::parse($record->tgl_mulai_publikasi);
            $eventEnd = Carbon::parse($record->tgl_selesai_publikasi);

            // Validasi jika event berada di luar bulan yang aktif
            if ($eventEnd->lessThan($monthStart) || $eventStart->greaterThan($monthEnd)) {
                return null;
            }

            // 2. Batasi tanggal agar tidak melewati batas awal dan akhir bulan (Clamping)
            $clampedStart = $eventStart->lessThan($monthStart) ? $monthStart : $eventStart;
            $clampedEnd = $eventEnd->greaterThan($monthEnd) ? $monthEnd : $eventEnd;
            // *Catatan: logika $clampedEnd diganti ke greaterThan agar tepat jika event melebihi akhir bulan
            // $startIndex = $clampedStart->diffInDays($monthStart) + 1;
            $startIndex = $monthStart->diffInDays($clampedStart) + 1;
            // 3. CARA MENGHITUNG JUMLAH HARI
            // Kita gunakan +1 karena perhitungan sewa baliho umumnya bersifat inklusif (hari mulai & selesai dihitung)
            $span = $clampedStart->diffInDays($clampedEnd) + 1;

            $endIndex = $startIndex + $span - 1;
            return [
                'id' => 'cetak|' . $record->id,
                'resourceId' => $record->titik_baliho_id,
                'title' => $title,
                'start' => $clampedStart->format('Y-m-d'),
                'end' => $clampedEnd->format('Y-m-d'),
                'color' => '#ca8a04',
                'startIndex' => (int) $startIndex,
                'span' => (int) $span,
                'endIndex' => (int) $endIndex,
            ];
        })->filter()->values()->toArray();

        // ... Lanjutkan dengan logika untuk resources dan return data
        //     ->whereBetween('tgl_mulai_publikasi', [
        //     $monthStart->startOfMonth()->toDateTimeString(), 
        //     $monthEnd->endOfMonth()->toDateTimeString()
        // ])
        // ->orderBy('tgl_mulai_publikasi', 'asc')
        // ->get();

        $daysInMonth = count($days);

        $resources = TitikBaliho::query()
            ->orderBy('ukuran_baliho_id', 'asc')
            ->orderBy('nama', 'desc')
            ->get()
            ->map(function ($record) use ($events, $daysInMonth) {
                $resourceEvents = collect($events)
                    ->where('resourceId', $record->id)
                    ->sortBy('startIndex')
                    ->values()
                    ->toArray();

                return [
                    'id' => $record->id,
                    'title' => $record->nama,
                    'ukuran_baliho' => $record->ukuranBaliho ? $record->ukuranBaliho->ukuran_panjang . 'x' . $record->ukuranBaliho->ukuran_lebar . ' ' . $record->ukuranBaliho->layout . ')' : 'Ukuran Tidak Diketahui',
                    'alamat' => strlen($record->alamat) > 60 ? substr($record->alamat, 0, 60) . '...' : $record->alamat,
                    'events' => $resourceEvents,
                    'segments' => $this->buildTimelineSegments($resourceEvents, $daysInMonth),
                ];
            })
            ->values()
            ->toArray();
        return compact('resources', 'events', 'days');
    }

    private function buildTimelineSegments(array $events, int $daysInMonth): array
    {
        if ($daysInMonth <= 0) {
            return [];
        }

        $boundaries = [1, $daysInMonth + 1];

        foreach ($events as $event) {
            if (! isset($event['startIndex'], $event['endIndex'])) {
                continue;
            }

            $start = max(1, (int) $event['startIndex']);
            $end = min($daysInMonth, (int) $event['endIndex']);

            if ($start > $end) {
                continue;
            }

            $boundaries[] = $start;
            $boundaries[] = $end + 1;
        }

        $boundaries = array_values(array_unique($boundaries));
        sort($boundaries);

        $segments = [];

        for ($index = 0; $index < count($boundaries) - 1; $index++) {
            $start = $boundaries[$index];
            $end = min($boundaries[$index + 1] - 1, $daysInMonth);

            if ($start > $end) {
                continue;
            }

            $segmentEvents = collect($events)
                ->filter(function ($event) use ($start, $end) {
                    return (int) $event['startIndex'] <= $end
                        && (int) $event['endIndex'] >= $start;
                })
                ->sortBy('startIndex')
                ->values()
                ->toArray();

            $segments[] = [
                'startIndex' => $start,
                'endIndex' => $end,
                'span' => $end - $start + 1,
                'events' => $segmentEvents,
            ];
        }

        return $segments;
    }



    public function showEventDetail($id)
    {
        [$type, $eventId] = explode('|', $id);

        if ($type === 'cetak') {
            $this->selectedEventDetails = PermohonanDetMedKomCetak::with(['kegiatan', 'titikBaliho'])->find($eventId);
        } elseif ($type === 'elektronik') {
            $this->selectedEventDetails = PermohonanDetMedKomElektronik::with(['kegiatan'])->find($eventId);
        }

        $this->dispatch('open-modal-kalender-baliho', id: 'event-detail-modal');
    }

    // public function updatedSelectedTrack()
    // {
    //     $calendarData = $this->getCalendarData();
    //     $this->events = $calendarData['events'];
    //     $this->resources = $calendarData['resources'];
    //     $this->dispatch('refresh-calendar', events: $this->events, resources: $this->resources);
    // }

    public function render()
    {
        // dd($this->events, $this->resources, $this->days);
        return view('livewire.kalender-baliho', [
            'events' => $this->events,
            'resources' => $this->resources,
            'days' => $this->days,
        ]);
    }
}
