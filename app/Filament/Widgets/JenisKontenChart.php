<?php

namespace App\Filament\Widgets;

use App\Models\PermohonanDetMedKomCetak;
use App\Models\PermohonanDetMedKomElektronik;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class JenisKontenChart extends ChartWidget
{
        protected static ?int $sort = 4;

    protected static ?string $heading = 'Fasilitasi Publikasi Tahun Ini';
    protected int | string | array $columnSpan = [
        'md' => 1,
    ];
protected static string $type = 'doughnut';
    protected function getData(): array
    {
        // $startOfMonth = Carbon::now()->startOfMonth();
        // $endOfMonth = Carbon::now()->endOfMonth();
        $startOfMonth = Carbon::now()->startOfYear();
        $endOfMonth = Carbon::now()->endOfYear();

      
        $dataCetak = PermohonanDetMedKomCetak::query()
            ->whereBetween('tgl_mulai_publikasi', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy('kegiatan_id')
            ->map(fn($group) => [
                'nama' => $group->first()->kegiatan?->nama ?? 'Tanpa Nama Kegiatan',
                'jumlah' => $group->count(),
                'tipe' => 'Media Cetak'
            ]);

        $dataElektronik = PermohonanDetMedKomElektronik::query()
            ->whereBetween('tgl_mulai_publikasi', [$startOfMonth, $endOfMonth])
            ->get()
            ->groupBy('kegiatan_id')
            ->map(fn($group) => [
                'nama' => $group->first()->kegiatan?->nama ?? 'Tanpa Nama Kegiatan',
                'jumlah' => $group->count(),
                'tipe' => 'Media Eletronik'
            ]);
        $gabungan = $dataCetak->concat($dataElektronik);
     
        return [
            'datasets' => [
                [
                    // 'label' => 'Jenis Konten',
                    'data' => $gabungan->pluck('jumlah')->toArray(),
                    'backgroundColor' => [
                        '#3b82f6', // Biru untuk Media Cetak
                        '#10b981', // Hijau untuk Media Elektronik
                        '#f59e0b', // Kuning untuk kategori lainnya
                        '#ef4444', // Merah untuk kategori lainnya
                        '#8b5cf6', // Ungu untuk kategori lainnya
                        '#ec4899', // Pink untuk kategori lainnya
                    ],
                ],
            ],
            'labels' => $gabungan->pluck('nama')->toArray(),
            'options' => [
                'scales' => [
                    'x' => [
                        'display' => false, // Menghilangkan sumbu X
                    ],
                    'y' => [
                        'display' => false, // Menghilangkan sumbu Y
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // Gunakan doughnut untuk visual yang lebih bersih
    }
}
