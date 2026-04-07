<?php

namespace App\Filament\Widgets;

use App\Models\TitikBaliho;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Color;
use Webbingbrasil\FilamentMaps\Actions\CenterMapAction;
use Webbingbrasil\FilamentMaps\Actions\ZoomAction;
use Webbingbrasil\FilamentMaps\Marker;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;

use function Symfony\Component\Clock\now;

class DashboardBalihoMap extends MapWidget
{
    protected static ?int $sort = 5;

    protected $listeners = [
        // 'updateMap' => '$refresh',
    ];
    protected int | string | array $columnSpan = 2;


    protected bool $rounded = true;    // Sudut peta jadi melengkung (lebih modern)
    // protected string | Htmlable | null $heading = 'Sebaran Lokasi Baliho';
    protected bool $hasBorder = false;

    public $filterDate = null;

    public function mount()
    {
        $this->filterDate = Carbon::now()->toDateString();
    }

    // 2. Override fungsi render agar kita bisa menyisipkan input filter di atas peta

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.widgets.dashboard-baliho-map-header');
    }

    public function setUp(): void
    {
        // dd('ddddddddd');
        $this
            ->height('400px')
            ->rounded()
            // mapOptions sangat berpengaruh untuk interaksi user
            ->mapOptions([
                'center' => [-7.5, 110.5], // Koordinat Tengah Jawa (Sekitar Jateng)  
                'zoom' => 10,                 // Tingkat kedekatan kamera
                'scrollWheelZoom' => true,   // Agar tidak sengaja zoom saat scroll halaman
            ])
            // ->mapMarkers($this->getMarkersFromDatabase())
        ;

        // Otomatis fokus ke semua titik yang ada
        $points = $this->getMarkersPoints();
        $points[] = [-7.567034785878844, 110.79615167728225];
        // dd($points);
        if (!empty($points)) {
            // $this->fitBounds($points);
            // $this->fitBounds(!empty($points) ? $points : [[-7.5, 110.5]]);
            $this->fitBounds(!empty($points) ? $points : [[-7.5, 110.5]]);
        }
    }

    protected function getMarkersFromDatabase(): array
    {
        // dd('fetching data from database with filter date: ' . $this->filterDate);
        // Mengambil data dengan eager loading relasi jika diperlukan (misal: ukuran)
        // $today = Carbon::today()->toDateString();
        $this->setUp();


        $selectedDate = $this->filterDate ?: Carbon::today()->toDateString();
        // dd($selectedDate);
        return TitikBaliho::with(['ukuranBaliho', 'permohonanDetMedKomCetak' => function ($query) use ($selectedDate) {
            $query->where('tgl_mulai_publikasi', '<=', $selectedDate)
                ->where('tgl_selesai_publikasi', '>=', $selectedDate)
                ->limit(1); // Ambil 1 saja dari database
        }])
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->get()
            ->map(function ($record) {
                $publikasiAktif = $record->permohonanDetMedKomCetak->first();

                $namaPublikasi = $publikasiAktif ? strtoupper($publikasiAktif->isi_konten) : 'KOSONG';
                $warnaStatus = $publikasiAktif ? '#16a34a' : '#e11d48';
                $warnaIcon = $publikasiAktif ? Marker::COLOR_BLUE : Marker::COLOR_GREEN;
                return Marker::make($record->id)
                    ->lat((float) $record->lat)
                    ->lng((float) $record->lng)
                    // ->color("#16a34a") // Warna marker berdasarkan status publikasi
                    ->color($warnaIcon) // Warna marker berdasarkan status publikasi
                    ->tooltip($record->nama)
                    // Contoh menampilkan detail teknis di popup
                    ->popup("
                    <strong style='font-size: 14px;'>{$record->nama}</strong><br>
                    <hr style='margin: 8px 0; border: 0; border-top: 1px solid #eee;'>
                    
                    <div style='margin-bottom: 5px;'>
                    <span style='font-size: 10px; color: gray; display: block;'>Publikasi Hari Ini:</span>
                    <strong style='color: {$warnaStatus}; font-size: 11px;'>
                    " . strtoupper($namaPublikasi) . "
                    </strong>
                    </div>
                    
                    <small style='color: #666;'>{$record->alamat}</small><br>
                        <span style='font-size: 11px; color: gray;'>
                            Ukuran: {$record->ukuranBaliho?->ukuran_panjang}x{$record->ukuranBaliho?->ukuran_lebar} m
                        </span>
                        
                ")

                ;
            })->toArray();
    }


    /**
     * Mengambil koordinat saja untuk fitur FitBounds (Fokus Peta)
     */
    protected function getMarkersPoints(): array
    {
        return TitikBaliho::whereNotNull('lat')
            ->whereNotNull('lng')
            ->get()
            ->map(fn($record) => [(float)$record->lat, (float)$record->lng])
            ->values()
            ->toArray() ?? [];
    }

    public function getActions(): array
    {
        $points = $this->getMarkersPoints();
        $points[] = [-7.567034785878844, 110.79615167728225];

        // $points = null;
        // dd($points);
        $this->mapMarkers($this->getMarkersFromDatabase());
        $this->getTableData();
        return [
            ZoomAction::make(),
            CenterMapAction::make()
                ->zoom(2)
                ->label('Fokuskan Semua Titik')
                // ->fitBounds($this->getMarkersPoints())
                // ->fitBounds($this->getFitBounds()),
                ->fitBounds(!empty($points) ? $points : [[-7.5, 110.5]]),
        ];
    }

    // Tambahkan di dalam class DashboardBalihoMap
    public function updatedFilterDate()
    {
        // dd($this);
        // Library ini membutuhkan setMarkers manual saat data berubah secara reaktif
        $this->mapMarkers($this->getMarkersFromDatabase());
    }
    public function getTableData()
    {
        $selectedDate = $this->filterDate ?: carbon::now()->toDateString();
        $selectedDate = $this->filterDate ?: carbon::now()->toDateString();
        // dd($selectedDate);       

        $materiBaliho =  TitikBaliho::with(['ukuranBaliho', 'permohonanDetMedKomCetak' => function ($query) use ($selectedDate) {
            $query->where('tgl_mulai_publikasi', '<=', $selectedDate)
                ->where('tgl_selesai_publikasi', '>=', $selectedDate)
                ->limit(1); // Ambil 1 saja dari database
        }])
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->get()
            ->sortByDesc(function ($titik) {
                return $titik->permohonanDetMedKomCetak->first()?->tgl_mulai_publikasi;
            });
        $materiBaliho = $materiBaliho->map(function ($record) {
            // $publikasi = $titik->permohonanDetMedKomCetak->first();
            $publikasiAktif = $record->permohonanDetMedKomCetak->first();
            $namaPublikasi = $publikasiAktif ? strtoupper($publikasiAktif->isi_konten) : 'KOSONG';

            return [
                'nama' => $record->nama,
                'konten' => $namaPublikasi,
                'tgl_mulai_publikasi' => $publikasiAktif ? Carbon::parse($publikasiAktif->tgl_mulai_publikasi)->format('Y-m-d') : '',
                'tgl_selesai_publikasi' => $publikasiAktif ? Carbon::parse($publikasiAktif->tgl_selesai_publikasi)->format('Y-m-d') : '',
                'status' => $publikasiAktif ? 'Terisi' : 'Tersedia',
                'warna' => $publikasiAktif ? 'text-success-600' : 'text-danger-600',
            ];
        });

        // dd($materiBaliho);
        return $materiBaliho;
    }
}
