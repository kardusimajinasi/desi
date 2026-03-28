<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class PermohonanCetakExport implements FromCollection, WithHeadings, WithMapping
{
    protected $records;

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    // Mendefinisikan Judul Kolom (Header)
    public function headings(): array
    {
        return [
            'No',
            'Instansi Permohonan',
            'Perihal Permohonan',
            'Isi Konten',
            'Tgl Mulai',
            'Tgl Selesai',
            'Detail',
            'Anggaran Belanja',
        ];
    }

    // Memetakan data ke kolom masing-masing
    public function map($record): array
    {
        static $no = 1; 

        $mulai = \Carbon\Carbon::parse($record->tgl_mulai_publikasi)->format('d/m/Y');
        $selesai = \Carbon\Carbon::parse($record->tgl_selesai_publikasi)->format('d/m/Y');

        $keterangan = $record->keterangan ?? '-';
        $keterangan_detail = '';

        if ($record->kegiatan_id == 'bd7e01de-430d-4336-8774-ed70142171d9') {
            $keterangan = $record->titikBaliho?->nama ?? '-';
            $keterangan_detail = "Ukuran: " . ($record->titikBaliho?->ukuranBaliho?->ukuran_panjang ?? '-') . "x" . ($record->titikBaliho?->ukuranBaliho?->ukuran_lebar ?? '-') . " m";
        } elseif ($record->kegiatan_id == '9e9e8cf5-d669-4088-bf31-94fdce52779c') {
            $keterangan = ($record->volume_hitung ?? '-') . " Rim";
        } elseif ($record->kegiatan_id == 'e32537d5-e045-4762-9f8a-70880b52d0bd') {
            $keterangan = "Ukuran: " . "{$record->panjang} x {$record->lebar} m";
            $keterangan_detail = "Total: " . ($record->volume_hitung ?? '0') . " m² ({$record->jumlah} Pcs)";
        } elseif ($record->kegiatan_id == 'cd6d6a81-e472-480b-8bf4-7144c0e75ed7') {
            $keterangan = ($record->volume_hitung ?? '-') . " Buku";
        }

        return [
            $no++,
            $record->permohonan?->instansi?->nama ?? '-',
            $record->permohonan?->perihal ?? '-',
            $record->isi_konten,
            $mulai,
            $selesai,
            $keterangan_detail ? $keterangan . " ({$keterangan_detail})" : $keterangan,
            $record->anggaranBelanja?->nama ?? '-',
        ];
    }
}
