<?php

namespace App\Filament\Resources\PermohonanDetMedKomElektronikResource\Pages;

use App\Filament\Resources\PermohonanDetMedKomElektronikResource;
use App\Models\Layanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanDetMedKomElektroniks extends ListRecords
{
    protected static string $resource = PermohonanDetMedKomElektronikResource::class;

  protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('exportRekapSemua')
                ->label('Export Rekap (Halaman Ini)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    // ->modalHeading('Preview Rekap Data')
                    // ->modalWidth('7xl') 
                    // ->modalSubmitAction(false) // Hilangkan tombol "Submit" karena ini hanya untuk lihat
                    // ->modalContent(function () {
                    // Mengambil query yang sudah difilter/search di tabel saat ini
                    $records = $this->getFilteredTableQuery()
                        ->with(['dokumentasi', 'kegiatan', 'permohonan.instansi' ])
                        ->get();
                    $namaLayanan = Layanan::where('id', 'c9730c78-1a46-4cf4-b75d-aaaf9fbfda56')->pluck('nama', 'id')->first() ?? 'rekap';



                    //         return view('permohonan.rekap_media_cetak_pdf', [
                    // 'records' => $records,
                    // 'namaLayanan' => $namaLayanan
                    // ]);

                    $pdf = Pdf::loadView('permohonan.rekap_media_elektronik_pdf', [
                        'records' => $records,
                        'namaLayanan' => $namaLayanan
                    ])->setPaper('a4', 'portrait');

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, "Rekap-Fasilitasi-" . date('d-m-Y') . ".pdf");
                }),
            // \Filament\Actions\CreateAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}