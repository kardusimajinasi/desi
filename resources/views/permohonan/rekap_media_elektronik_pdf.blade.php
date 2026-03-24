<!DOCTYPE html>
<html>
<head>
    <title>Rekap Dokumentasi Elektronik</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; line-height: 1.4; }
        .page-break { page-break-after: always; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; word-wrap: break-word; }
        th { background-color: #f2f2f2; }
        .info-permohonan { background-color: #f9f9f9; font-weight: bold; }
        .gallery { margin-bottom: 10px; }
        .photo-box { display: inline-block; width: 30%; margin-left: 1%; vertical-align: top; text-align: center; border: 1px solid #ddd; padding: 3px; }
        .img-doc { max-height: 100%; width: 188px; object-fit: contain; }
        .caption { font-size: 10px; margin-top: 5px; font-weight: bold; color: #555; }
        .label-detail { font-size: 10px; color: #666; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <h2>REKAP DOKUMENTASI FASILITASI</h2>
        <h3>{{ strtoupper($namaLayanan ?? 'LAYANAN MEDIA Elektronik') }}</h3>
    </div>

    @php $currentPermohonanId = null; @endphp

    @foreach ($records as $key => $record)
        {{-- Logika Grouping Berdasarkan Permohonan --}}
        @if ($currentPermohonanId !== $record->permohonan_id)
            @if (!$loop->first) <div class="page-break"></div> @endif
            
            <table style="margin-top: 10px;">
                <tr class="info-permohonan">
                    <td colspan="4">
                        Pemohon: {{ $record->permohonan->instansi->nama }}, {{ $record->permohonan->tgl_surat ? \Carbon\Carbon::parse($record->permohonan->tgl_surat)->format('d/m/Y') : '-' }} <br>
                        Perihal: {{ $record->permohonan->perihal }} <br>
                        No.Surat: {{ $record->permohonan->no_surat ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 35%">Konten & Periode</th>
                    <th style="width: auto">Detail Teknis</th>
                    <th style="width: 20%">Anggaran</th>
                </tr>
            @php $currentPermohonanId = $record->permohonan_id; @endphp
        @endif

        {{-- Logika Penentuan Keterangan Teknis --}}
        @php
            $mulai = \Carbon\Carbon::parse($record->tgl_mulai_publikasi)->format('d/m/Y');
            $selesai = \Carbon\Carbon::parse($record->tgl_selesai_publikasi)->format('d/m/Y');
            
            $keterangan = $record->keterangan ?? '-';
            $keterangan_detail = '';

            if ($record->kegiatan_id == '76a8d937-6879-4f36-91af-4bef7c8771ce') { 
                $keterangan = ($record->volume_hitung ?? '-') . " Tampilan"; 
            } else {
                $keterangan = ($record->volume_hitung ?? '-') ;
            }
        @endphp

        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>
                <strong>{{ $record->isi_konten }}</strong><br>
                <span class="label-detail">{{ $mulai }} - {{ $selesai }} ({{ $record->durasi_hari }} hari)</span>
            </td>
            <td>
                [{{ $record->kegiatan?->nama ?? '' }}] {{ $keterangan }}<br>
                <span class="label-detail">{{ $keterangan_detail }}</span>
            </td>
            <td>{{ $record->anggaranBelanja->nama ?? '-' }}</td>
        </tr>
        
        {{-- Gallery Foto per Record --}}
        <tr>
            <td colspan="4">
                <div class="gallery">
                    <div style="margin-bottom: 5px;"><strong>Lampiran Dokumentasi:</strong></div>
                    @forelse($record->dokumentasi as $doc)
                        <div class="photo-box">
                            @php
                                $path = storage_path('app/private/' . $doc->lokasi_file);
                                // dd(1, $path);
                                if (file_exists($path)) {
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                } else { $base64 = null; }
                            @endphp

                            @if ($base64)
                                <img src="{{ $base64 }}" class="img-doc">
                            @else
                                <div style="height: 80px; background: #eee; padding-top: 30px;">Gambar tidak ditemukan</div>
                            @endif
                            <div class="caption">{{ $doc->nama ? $doc->nama . ' - ' : '' }} {{ $doc->jenis }} - {{ $doc->tanggal_dokumentasi }}</div>
                        </div>
                    @empty
                        <span class="label-detail">Tidak ada lampiran foto.</span>
                    @endforelse
                </div>
            </td>
        </tr>

        {{-- Tutup tabel jika permohonan selanjutnya berbeda atau sudah akhir loop --}}
        @if ($loop->last || ($records[$key + 1]->permohonan_id !== $currentPermohonanId))
            </table>
        @endif
    @endforeach

</body>
</html>