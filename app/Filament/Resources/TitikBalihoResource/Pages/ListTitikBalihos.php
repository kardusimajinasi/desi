<?php

namespace App\Filament\Resources\TitikBalihoResource\Pages;

use App\Filament\Resources\TitikBalihoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTitikBalihos extends ListRecords
{
    protected static string $resource = TitikBalihoResource::class;

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
    return [
        \App\Filament\Resources\TitikBalihoResource\Widgets\BalihoMap::class,
    ];
}
}
