<?php

namespace App\Filament\Resources\PermohonanDetMedKomCetakResource\Pages;

use App\Filament\Resources\PermohonanDetMedKomCetakResource;
use App\Models\Layanan;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanDetMedKomCetaks extends ListRecords
{
    protected static string $resource = PermohonanDetMedKomCetakResource::class;

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
                        ->with(['dokumentasi', 'kegiatan', 'permohonan.instansi', 'titikBaliho.ukuranBaliho'])
                        ->get();
                    $namaLayanan = Layanan::where('id', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1')->pluck('nama', 'id')->first() ?? 'rekap';



                    //         return view('permohonan.rekap_media_cetak_pdf', [
                    // 'records' => $records,
                    // 'namaLayanan' => $namaLayanan
                    // ]);

                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('permohonan.rekap_media_cetak_pdf', [
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
