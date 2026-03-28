<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class PermohonanElektronikExport implements FromCollection, WithHeadings, WithMapping
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

        if ($record->kegiatan_id == '76a8d937-6879-4f36-91af-4bef7c8771ce') {
            $keterangan = ($record->volume_hitung ?? '-') . ' Tampilan';
        } else {
            $keterangan = $record->volume_hitung ?? '-';
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
