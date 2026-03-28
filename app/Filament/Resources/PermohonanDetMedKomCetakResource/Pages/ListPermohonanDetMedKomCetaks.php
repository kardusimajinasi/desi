<?php

namespace App\Filament\Resources\PermohonanDetMedKomCetakResource\Pages;

use App\Filament\Resources\PermohonanDetMedKomCetakResource;
use App\Models\Layanan;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Exports\PermohonanCetakExport;
use Maatwebsite\Excel\Facades\Excel;

class ListPermohonanDetMedKomCetaks extends ListRecords
{
    protected static string $resource = PermohonanDetMedKomCetakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('exportRekapSemua')
                ->label('Export Rekap (Pdf)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('warning')
                ->action(function () {
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
            \Filament\Actions\Action::make('exportRekapExcel')
                ->label('Export Rekap (Excel)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(function () {
                    $records = $this->getFilteredTableQuery()
                        ->with(['dokumentasi', 'kegiatan', 'permohonan.instansi'])
                        ->get();
                    $namaLayanan = Layanan::where('id', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1')->pluck('nama', 'id')->first() ?? 'rekap';

                    // $pdf = Pdf::loadView('permohonan.rekap_media_elektronik_pdf', [
                    //     'records' => $records,
                    //     'namaLayanan' => $namaLayanan
                    // ])->setPaper('a4', 'portrait');

                    // return response()->streamDownload(function () use ($pdf) {
                    //     echo $pdf->stream();
                    // }, "Rekap-Fasilitasi-" . date('d-m-Y') . ".pdf");

                    return Excel::download(
                        new PermohonanCetakExport($records, $namaLayanan),
                        'Rekap-Publikasi-Cetak-' . now()->format('d-m-Y') . '.xlsx'
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
