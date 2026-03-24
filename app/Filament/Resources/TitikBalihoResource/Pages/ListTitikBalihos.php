<?php

namespace App\Filament\Resources\TitikBalihoResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TitikBalihoResource;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListTitikBalihos extends ListRecords
{
    protected static string $resource = TitikBalihoResource::class;
    use ExposesTableToWidgets;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderWidgets(): array
    {
        // dd($this);
        return [
            \App\Filament\Resources\TitikBalihoResource\Widgets\BalihoMap::class,
        ];
    }
}
