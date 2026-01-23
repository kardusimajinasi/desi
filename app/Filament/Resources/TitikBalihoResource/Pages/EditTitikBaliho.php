<?php

namespace App\Filament\Resources\TitikBalihoResource\Pages;

use App\Filament\Resources\TitikBalihoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTitikBaliho extends EditRecord
{
    protected static string $resource = TitikBalihoResource::class;

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
