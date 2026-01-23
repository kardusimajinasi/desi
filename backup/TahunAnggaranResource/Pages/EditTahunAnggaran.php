<?php

namespace App\Filament\Resources\TahunAnggaranResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\TahunAnggaranResource;

class EditTahunAnggaran extends EditRecord
{
    protected static string $resource = TahunAnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave()
    {
        $data = $this->record;
        try {
            DB::transaction(function () use ($data) {
                if ($data->aktif === true) {
                    $data->where('id', '!=', $data->id)
                        ->update(['aktif' => '0']);
                }
            });
        } catch (\Exception $e) {
            
            // Berikan notifikasi error ke user
            Notification::make()
                ->title('Gagal Memperbarui status aktif Tahun Anggaran')
                // ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->persistent()
                ->send();

            // Berhenti dan kembali ke form
            $this->halt();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
