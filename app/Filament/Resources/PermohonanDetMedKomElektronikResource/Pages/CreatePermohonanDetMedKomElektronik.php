<?php

namespace App\Filament\Resources\PermohonanDetMedKomElektronikResource\Pages;

use App\Filament\Resources\PermohonanDetMedKomElektronikResource;
use App\Models\AnggaranBelanja;
use App\Models\PermohonanDetMedKomCetak;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreatePermohonanDetMedKomElektronik extends CreateRecord
{
    protected static string $resource = PermohonanDetMedKomElektronikResource::class;

    
    protected function afterCreate()
    {
        $data = $this->record;
        try {
            DB::transaction(function () use ($data) {
                DB::transaction(function () use ($data) {
                $anggaranId = $data->anggaran_id;
 
                // dd($anggaranId);
                if (!$anggaranId || $anggaranId == '1na-1') return;

                $anggaran = AnggaranBelanja::find($anggaranId);
                if (!$anggaran) return;
                $totalPenggunaan = PermohonanDetMedKomCetak::where('anggaran_id', $anggaranId)
                    ->sum('volume_hitung');
                // dd($anggaran->volume_awal, $totalPenggunaan);
                $anggaran->update([
                    'sisa_volume' => $anggaran->volume_awal - $totalPenggunaan
                    // 'sisa_volume' => 0
                ]);

              
            });
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
