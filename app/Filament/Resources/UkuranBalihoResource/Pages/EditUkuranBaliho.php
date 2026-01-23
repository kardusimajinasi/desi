<?php

namespace App\Filament\Resources\UkuranBalihoResource\Pages;

use App\Filament\Resources\UkuranBalihoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUkuranBaliho extends EditRecord
{
    protected static string $resource = UkuranBalihoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

        protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
