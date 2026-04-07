<?php

namespace App\Filament\Resources\PermohonanResource\Pages;

use App\Filament\Resources\PermohonanResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePermohonan extends CreateRecord
{
    protected static string $resource = PermohonanResource::class;

    //     protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->hidden(); // Ini akan menyembunyikan tombol "Simpan & Buat Lagi"
    }
}
