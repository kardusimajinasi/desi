<?php

namespace App\Filament\Resources\PermohonanResource\Pages;

use App\Filament\Resources\PermohonanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermohonan extends EditRecord
{
    protected static string $resource = PermohonanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        // Cek apakah user memiliki akses untuk mengedit
        if (auth()->user()->hasRole('Pimpinan')) {
            // Jika viewer, hanya tampilkan tombol Batal (atau kosongkan sama sekali)
            return [
                $this->getCancelFormAction()
                    ->label('Kembali')
                    ->icon('heroicon-m-arrow-left') // Menambahkan ikon panah ke kiri
                    ->color('gray'),
            ];
        }

        // Jika bukan viewer, tampilkan aksi standar (Simpan & Batal)
        return parent::getFormActions();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
