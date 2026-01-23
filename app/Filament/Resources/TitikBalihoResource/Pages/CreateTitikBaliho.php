<?php

namespace App\Filament\Resources\TitikBalihoResource\Pages;

use App\Filament\Resources\TitikBalihoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTitikBaliho extends CreateRecord
{
    protected static string $resource = TitikBalihoResource::class;

        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
