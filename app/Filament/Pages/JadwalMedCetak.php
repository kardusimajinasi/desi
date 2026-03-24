<?php

namespace App\Filament\Pages;

use App\Models\Kegiatan;
use Filament\Pages\Page;

class JadwalMedCetak extends Page
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.pages.daftar-jadwal';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static string $view = 'filament.pages.jadwal-med-cetak';
    protected static ?string $title = 'Jadwal Publikasi';
    
    public $selectedTrack = '';

    public function getTracks(): array
    {
        // Mengambil daftar kegiatan untuk dropdown filter
        return Kegiatan::pluck('nama', 'id')->toArray();
    }
}
