<?php

namespace App\Filament\Resources\TitikBalihoResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\TitikBaliho;
use Webbingbrasil\FilamentMaps\Marker;
use Webbingbrasil\FilamentMaps\MarkerCluster;
use Filament\Widgets\TableWidget as BaseWidget;
use Webbingbrasil\FilamentMaps\Widgets\MapWidget;
use Webbingbrasil\FilamentMaps\Actions\ZoomAction;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Webbingbrasil\FilamentMaps\Actions\CenterMapAction;
use App\Filament\Resources\TitikBalihoResource\Pages\ListTitikBalihos;

class BalihoMap extends MapWidget
{
    use InteractsWithPageTable; // WAJIB ADA
    public function getTablePage()
    {
        return ListTitikBalihos::class;
    }

    protected $listeners = [
        'updateMap' => '$refresh',
    //     'tableFiltersApplied' => '$refresh',
    // 'tableSearchApplied' => '$refresh',
    // 'tableSearch' => '$refresh',
    ];

    // public function mount(): void
    // {
    //     $this->tableColumnSearches = [];
    //     $this->tableSearch = request()->query('tableSearch', '');
    // }
    
    protected int | string | array $columnSpan = 2;
    protected bool $rounded = true;    // Sudut peta jadi melengkung (lebih modern)
    // protected string | Htmlable | null $heading = 'Sebaran Lokasi Baliho';
    protected bool $hasBorder = false;

    public function setUp(): void
    {
        // dd($this);
        $this
            ->height('360px')
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
        if (!empty($points)) {
            $this->fitBounds($points);
        }
        // Di dalam setUp()
        // $locations = \App\Models\TitikBaliho::all(['lat', 'lng']);
        // if ($locations->isNotEmpty()) {
        //     $bounds = $locations->map(fn($loc) => [(float)$loc->lat, (float)$loc->lng])->toArray();
        //     $this->fitBounds($bounds);
        // }
    }
    /**
     * Mengambil data marker secara dinamis dari database
     */
    protected function getMarkersFromDatabase(): array
    {
        // $this->tableSearch = request()->query('tableSearch');
    // $filters = request()->query('tableFilters');
        // dd($this, $this->tableSearch);

        // getPageTableRecords() memastikan data yang muncul sesuai dengan filter/search di tabel
        return $this->getPageTableRecords()->map(function (TitikBaliho $record) {
            return Marker::make($record->id)
                ->lat((float) $record->lat)
                ->lng((float) $record->lng)
                ->tooltip($record->nama)
                ->popup("<strong>{$record->nama}</strong><br>{$record->alamat}");
        })->toArray();
    }

    /**
     * Mengambil koordinat saja untuk fitur FitBounds (Fokus Peta)
     */
    protected function getMarkersPoints(): array
    {
        // dd($this);
        return $this->getPageTableRecords()
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->map(fn($record) => [(float) $record->lat, (float) $record->lng])
            // ->toArray();
            ->values() // Reset kunci array agar berurutan
            ->toArray() ?? [];
    }

    public function getActions(): array
    {
        // dd($this,  $this->getPageTableQuery(), $this->getPageTableRecords());
        $points = $this->getMarkersPoints();
        // dd($points);
        $this->mapMarkers($this->getMarkersFromDatabase());
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
}
