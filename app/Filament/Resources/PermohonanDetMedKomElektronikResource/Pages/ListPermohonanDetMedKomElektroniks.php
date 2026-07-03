<?php

namespace App\Filament\Resources\PermohonanDetMedKomElektronikResource\Pages;

use App\Filament\Resources\PermohonanDetMedKomElektronikResource;
use App\Models\Layanan;
use App\Exports\PermohonanElektronikExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanDetMedKomElektroniks extends ListRecords
{
    protected static string $resource = PermohonanDetMedKomElektronikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('exportRekapSemua')
                ->label('Export Rekap (pdf)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('warning')
                ->action(function () {
                    $records = $this->getFilteredTableQuery()
                        ->with(['dokumentasi', 'kegiatan', 'permohonan.instansi'])
                        ->orderBy('permohonan_id', 'asc')
                        ->get();
                    $namaLayanan = Layanan::where('id', 'c9730c78-1a46-4cf4-b75d-aaaf9fbfda56')->pluck('nama', 'id')->first() ?? 'rekap';

                    $pdf = Pdf::loadView('permohonan.rekap_media_elektronik_pdf', [
                        'records' => $records,
                        'namaLayanan' => $namaLayanan
                    ])->setPaper('a4', 'portrait');
                    // $pdf->render();

                    // Ambil instansi DOMPDF bawaannya, lalu set backend ke CPDF via Options Manager
                    // $pdf->getDomPDF()->getOptions()->set('pdfBackend', 'CPDF');
                    // return $pdf->download('dokumen.pdf');
                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, "Rekap-Fasilitasi-" . date('d-m-Y') . ".pdf");
                }),
            \Filament\Actions\Action::make('exportRekapExcel')
                ->label('Export Rekap (Excel)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    $records = $this->getFilteredTableQuery()
                        ->with(['dokumentasi', 'kegiatan', 'permohonan.instansi'])
                        ->get();
                    $namaLayanan = Layanan::where('id', 'c9730c78-1a46-4cf4-b75d-aaaf9fbfda56')->pluck('nama', 'id')->first() ?? 'rekap';

                    return Excel::download(
                        new PermohonanElektronikExport($records, $namaLayanan),
                        'Rekap-Publikasi-Elektronik-' . now()->format('d-m-Y') . '.xlsx'
                    );
                }),
            // \Filament\Actions\CreateAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
