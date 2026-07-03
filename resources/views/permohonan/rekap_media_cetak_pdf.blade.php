<!DOCTYPE html>
<html>

<head>
    <title>Rekap Dokumentasi Cetak</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }

        .page-break {
            page-break-after: always;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        .info-permohonan {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .gallery {
            margin-bottom: 10px;
        }

        .photo-box {
            display: inline-block;
            width: 30%;
            margin-left: 1%;
            vertical-align: top;
            text-align: center;
            border: 1px solid #ddd;
            padding: 3px;
        }

        .img-doc {
            max-height: 100%;
            width: 188px;
            object-fit: contain;
        }

        .caption {
            font-size: 10px;
            margin-top: 5px;
            font-weight: bold;
            color: #555;
        }

        .label-detail {
            font-size: 10px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>REKAP DOKUMENTASI FASILITASI</h2>
        <h3>{{ strtoupper($namaLayanan ?? 'LAYANAN MEDIA CETAK') }}</h3>
    </div>

    @php $currentPermohonanId = null; @endphp

    <table style="margin-top: 10px;">
        @foreach ($records as $key => $record)
            {{-- Logika Grouping Berdasarkan Permohonan --}}
            @if ($currentPermohonanId !== $record->permohonan_id)
                @if (!$loop->first)
                    <div class="page-break"></div>
                @endif

                <tr class="info-permohonan">
                    <td colspan="4">
                        Pemohon: {{ $record->permohonan->instansi->nama }},
                        {{ $record->permohonan->tgl_surat ? \Carbon\Carbon::parse($record->permohonan->tgl_surat)->format('d/m/Y') : '-' }}
                        <br>
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

                if ($record->kegiatan_id == 'bd7e01de-430d-4336-8774-ed70142171d9') {
                    $keterangan = $record->titikBaliho?->nama ?? '-';
                    $keterangan_detail =
                        'Ukuran: ' .
                        ($record->titikBaliho?->ukuranBaliho?->ukuran_panjang ?? '-') .
                        'x' .
                        ($record->titikBaliho?->ukuranBaliho?->ukuran_lebar ?? '-') .
                        ' m';
                } elseif ($record->kegiatan_id == '9e9e8cf5-d669-4088-bf31-94fdce52779c') {
                    $keterangan = ($record->volume_hitung ?? '-') . ' Rim';
                } elseif ($record->kegiatan_id == 'e32537d5-e045-4762-9f8a-70880b52d0bd') {
                    $keterangan = "{$record->panjang} x {$record->lebar} m";
                    $keterangan_detail = 'Total: ' . ($record->volume_hitung ?? '0') . " m² ({$record->jumlah} Pcs)";
                } elseif ($record->kegiatan_id == 'cd6d6a81-e472-480b-8bf4-7144c0e75ed7') {
                    $keterangan = ($record->volume_hitung ?? '-') . ' Buku';
                }
            @endphp

            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>
                    <strong>{{ $record->isi_konten }}</strong><br>
                    <span class="label-detail">{{ $mulai }} - {{ $selesai }} ({{ $record->durasi_hari }}
                        hari)</span>
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
                                    // $imagePath = storage_path('app/private/' . $doc->lokasi_file); // sesuaikan dengan path gambar Anda
                                    // $imageData = base64_encode(file_get_contents($imagePath));
                                    // $imageSrc = 'data:image/png;base64,' . $imageData; // gunakan image/jpeg jika file .jpg

                                    // $imagePath = storage_path('app/private/' . $doc->lokasi_file);
                                    // if (file_exists($imagePath)) {
                                    //     $mime = mime_content_type($imagePath);
                                    //     $imageData = base64_encode(file_get_contents($imagePath));
                                    //     $imageSrc = 'data:' . $mime . ';base64,' . $imageData;
                                    //     // ukuran byte
                                    //     $sizeBytes = filesize($imagePath);
                                    //     $sizeMB = number_format($sizeBytes / 1024 / 1024, 2);
                                    //     $mime = mime_content_type($imagePath);
                                    //     $filename = basename($imagePath);
                                    //     // if ($mime == 'image/png') {
                                    //     //     $image = new Imagick($path);
                                    //     //     $image->setImageBackgroundColor('white');
                                    //     //     $image = $image->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);
                                    //     //     $newPath = storage_path('app/temp/' . uniqid() . '.jpg');
                                    //     //     $image->setImageFormat('jpg');
                                    //     //     $image->writeImage($newPath);
                                    //     // }
                                    // } else {
                                    //     $imageSrc = null;
                                    //     $sizeMB = null;
                                    //     $mime = null;
                                    //     $filename = null;
                                    // }

                                    $imagePath = storage_path('app/private/' . $doc->lokasi_file);
                                    $imageSrc = null;
                                    if (file_exists($imagePath)) {
                                        $mime = mime_content_type($imagePath);
                                        // ukuran file
                                        $sizeBytes = filesize($imagePath);
                                        $sizeMB = number_format($sizeBytes / 1024 / 1024, 2);
                                        $filename = basename($imagePath);

                                        if ($mime === 'image/png') {
                                            if ($mime === 'image/png') {
                                                $img = imagecreatefrompng($imagePath);
                                                ob_start();
                                                imagejpeg($img, null, 90);
                                                $imageData = ob_get_clean();
                                                imagedestroy($img);
                                                $imageSrc = 'data:image/jpeg;base64,' . base64_encode($imageData);
                                                $mime = 'image/jpeg';
                                                $imagePath = null; // Hapus path asli karena sudah diubah ke JPEG sementara
                                            }
                                   
                                        }

                                        if (file_exists($imagePath)) {
                                            $imageData = base64_encode(file_get_contents($imagePath));
                                            $imageSrc = 'data:' . $mime . ';base64,' . $imageData;
                                        }
                                    } else {
                                        $imageSrc = null;
                                        $sizeMB = null;
                                        $mime = null;
                                        $filename = null;
                                    }

                                @endphp

                                @if ($imageSrc)
                                    <img src="{{ $imageSrc }}" class="img-doc">
                                    {{-- <img src="file://{{ $imageSrc }}" class="img-doc"> --}}
                                    {{-- <div>
                                        File: {{ $filename }} <br>
                                        Tipe: {{ $mime }} <br>
                                        Ukuran: {{ $sizeMB }} MB
                                    </div> --}}
                                @else
                                    <div style="height: 80px; background: #eee; padding-top: 30px;">Gambar tidak
                                        ditemukan</div>
                                @endif
                                <div class="caption">{{ $doc->nama ? $doc->nama . ' - ' : '' }} {{ $doc->jenis }} -
                                    {{ $doc->tanggal_dokumentasi }}</div>
                            </div>
                        @empty
                            <span class="label-detail">Tidak ada lampiran foto.</span>
                        @endforelse
                    </div>
                </td>
            </tr>

            {{-- Tutup tabel jika permohonan selanjutnya berbeda atau sudah akhir loop --}}
            {{-- @if ($loop->last || $records[$key + 1]->permohonan_id !== $currentPermohonanId)
        @endif --}}
        @endforeach
    </table>

    @php
        // dd($records);
    @endphp
</body>

</html>
