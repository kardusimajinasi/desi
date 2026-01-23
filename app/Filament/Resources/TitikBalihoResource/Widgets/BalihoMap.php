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
    public function getTablePage(): string
    {
        return ListTitikBalihos::class;
    }
    protected int | string | array $columnSpan = 2;
    protected bool $rounded = true;    // Sudut peta jadi melengkung (lebih modern)
    // protected string | Htmlable | null $heading = 'Sebaran Lokasi Baliho';
    protected bool $hasBorder = false;

    public function setUp(): void
    {
        $this
            ->height('360px')
            ->rounded()
            // mapOptions sangat berpengaruh untuk interaksi user
            ->mapOptions([
                'center' => [-7.5, 110.5], // Koordinat Tengah Jawa (Sekitar Jateng)  
                'zoom' => 10,                 // Tingkat kedekatan kamera
                'scrollWheelZoom' => true,   // Agar tidak sengaja zoom saat scroll halaman
            ])->mapMarkers($this->getMarkersFromDatabase());

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
        return $this->getPageTableRecords()
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->map(fn ($record) => [(float) $record->lat, (float) $record->lng])
            ->toArray();
    }
    // public function getMarkers(): array
    // {
    //     // return $this->getPageTableRecords()->map(function (TitikBaliho $record) {
    //     //     return [
    //     //         'lat' => (float) $record->lat,
    //     //         'lng' => (float) $record->lng,
    //     //         'label' => $record->nama,
    //     //         'popup' => "<strong>{$record->nama}</strong><br>{$record->alamat}",
    //     //     ];
    //     // })->toArray();
    //     // return [
    //     //     Marker::make('pos2')->lat(-15.7942)->lng(-47.8822)->popup('Hello Brasilia!'),
    //     //     Marker::make('pos2')->lat(-16.7942)->lng(47.8822)->popup('Hello !'),
    //     // ];
    // }

    public function getActions(): array
    {
        return [
            ZoomAction::make(),
            CenterMapAction::make()
                ->zoom(2)
                ->label('Fokuskan Semua Titik')
                // ->fitBounds($this->getMarkersPoints())
                ->fitBounds($this->getFitBounds()),
        ];
    }

    // protected function getMarkersPoints(): array
    // {
    //     return $this->getPageTableRecords()
    //         ->map(fn ($record) => [(float) $record->lat, (float) $record->lng])
    //         ->toArray();
    // }

    // protected function getMarkers(): array
    // {
    //     return $this->getPageTableRecords()->map(function (TitikBaliho $record) {
    //         return [
    //             'lat' => (float) $record->lat,
    //             'lng' => (float) $record->lng,
    //             'label' => $record->nama,
    //             'popup' => "<strong>{$record->nama}</strong>",
    //         ];
    //     })->toArray();
    // }
    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->query(
    //             // ...
    //         )
    //         ->columns([
    //             // ...
    //         ]);
    // }
}
