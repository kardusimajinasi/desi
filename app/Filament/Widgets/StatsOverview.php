<?php

namespace App\Filament\Widgets;

use App\Models\Permohonan;
use App\Models\PermohonanDetMedKomCetak;
use App\Models\PermohonanDetMedKomElektronik;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        // Rentang waktu bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // 1. Total Permohonan dalam sebulan (dari tabel permohonan)
        $totalPermohonan = Permohonan::whereBetween('tanggal_surat', [$startOfMonth, $endOfMonth])
            ->count();

        // 2. Titik Baliho Terpasang dalam sebulan (kegiatan_id spesifik baliho)
        $balihoTerpasang = PermohonanDetMedKomCetak::where('kegiatan_id', 'bd7e01de-430d-4336-8774-ed70142171d9')
            ->where(function ($query) use ($startOfMonth, $endOfMonth) {
                $query
                    // ->whereBetween('tgl_mulai_publikasi', [$startOfMonth, $endOfMonth])
                    //   ->orWhereBetween('tgl_selesai_publikasi', [$startOfMonth, $endOfMonth])
                      ->where('tgl_mulai_publikasi', '<=', $endOfMonth) // Mulai sebelum bulan ini berakhir
              ->where('tgl_selesai_publikasi', '>=', $startOfMonth); // Selesai setelah bulan ini dimulai;
            })
            ->count();

        // 3. Jumlah Konten Media Cetak Terpublikasi (selain baliho)
        $kontenCetak = PermohonanDetMedKomCetak::
            // where('kegiatan_id', '!=', 'bd7e01de-430d-4336-8774-ed70142171d9')
            // whereBetween('tgl_mulai_publikasi', [$startOfMonth, $endOfMonth])
            // ->orWhereBetween('tgl_selesai_publikasi', [$startOfMonth, $endOfMonth])
            where('tgl_mulai_publikasi', '<=', $endOfMonth) // Mulai sebelum bulan ini berakhir
              ->where('tgl_selesai_publikasi', '>=', $startOfMonth) // Selesai setelah bulan ini dimulai
            ->count();

        // 4. Konten Media Elektronik Terpublikasi (Media Sosial/Videotron dll)
        // Asumsi Anda memiliki tabel atau model terpisah untuk elektronik
        $kontenElektronik = PermohonanDetMedKomElektronik::
            // whereBetween('tgl_mulai_publikasi', [$startOfMonth, $endOfMonth])
            // ->orWhereBetween('tgl_selesai_publikasi', [$startOfMonth, $endOfMonth])
            where('tgl_mulai_publikasi', '<=', $endOfMonth) // Mulai sebelum bulan ini berakhir
              ->where('tgl_selesai_publikasi', '>=', $startOfMonth) // Selesai setelah bulan ini dimulai
            ->count();

        return [
            Stat::make('Total Permohonan', $totalPermohonan . ' Surat')
                ->description('Masuk bulan ini')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary'),

            Stat::make('Baliho Terpasang', $balihoTerpasang . ' Titik')
                ->description('Distribusi baliho kota')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('success'),

            Stat::make('Konten Media Cetak', $kontenCetak . ' Item')
                ->description('Flyer, Spanduk, Baliho, dll')
                ->descriptionIcon('heroicon-m-printer')
                ->color('warning'),

            Stat::make('Media Elektronik', $kontenElektronik . ' Konten')
                ->description('Running text')
                ->descriptionIcon('heroicon-m-computer-desktop')
                ->color('info'),
        ];
    }
}