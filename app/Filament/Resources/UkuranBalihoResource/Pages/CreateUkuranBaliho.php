<?php

namespace App\Filament\Resources\UkuranBalihoResource\Pages;

use App\Filament\Resources\UkuranBalihoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUkuranBaliho extends CreateRecord
{
    protected static string $resource = UkuranBalihoResource::class;

        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
