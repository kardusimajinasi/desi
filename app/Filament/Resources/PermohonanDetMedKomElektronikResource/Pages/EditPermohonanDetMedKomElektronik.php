<?php

namespace App\Filament\Resources\PermohonanDetMedKomElektronikResource\Pages;

use App\Filament\Resources\PermohonanDetMedKomElektronikResource;
use App\Models\AnggaranBelanja;
use App\Models\PermohonanDetMedKomCetak;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditPermohonanDetMedKomElektronik extends EditRecord
{
    protected static string $resource = PermohonanDetMedKomElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

        protected function afterDelete()
    {
        $data = $this->record;
        try {
            DB::transaction(function () use ($data) {
                $anggaranId = $data->anggaran_id;
                if (!$anggaranId || $anggaranId == '1na-1') return;

                $anggaran = AnggaranBelanja::find($anggaranId);
                if (!$anggaran) return;
                $totalPenggunaan = PermohonanDetMedKomCetak::where('anggaran_id', $anggaranId)
                    ->sum('volume_hitung');
                $anggaran->update([
                    'sisa_volume' => $anggaran->volume_awal - $totalPenggunaan
                ]);
            });
        } catch (\Exception $e) {

            // Berikan notifikasi error ke user
            Notification::make()
                ->title('Gagal Memperbarui Anggaran')
                // ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->persistent()
                ->send();

            // Berhenti dan kembali ke form
            $this->halt();
        }
    }   

    protected function afterSave()
    {
        $data = $this->record;

        try {
            DB::transaction(function () use ($data) {
                $anggaranId = $data->anggaran_id;
                $previousAnggaranId = $data->getPrevious('anggaran_id')['anggaran_id'] ?? null;

                if ($previousAnggaranId && $previousAnggaranId != '1na-1') {
                    $anggaran = AnggaranBelanja::find($previousAnggaranId);
                    if (!$anggaran) return;
                    $totalPenggunaan = PermohonanDetMedKomCetak::where('anggaran_id', $previousAnggaranId)
                        ->sum('volume_hitung');
                    $anggaran->update([
                        'sisa_volume' => $anggaran->volume_awal - $totalPenggunaan
                    ]);
                }


                // dd($anggaranId);
                if (!$anggaranId || $anggaranId == '1na-1') return;

                $anggaran = AnggaranBelanja::find($anggaranId);
                if (!$anggaran) return;
                $totalPenggunaan = PermohonanDetMedKomCetak::where('anggaran_id', $anggaranId)
                    ->sum('volume_hitung');
                $anggaran->update([
                    'sisa_volume' => $anggaran->volume_awal - $totalPenggunaan
                ]);
            });
        } catch (\Exception $e) {

            // Berikan notifikasi error ke user
            Notification::make()
                ->title('Gagal Memperbarui Anggaran')
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