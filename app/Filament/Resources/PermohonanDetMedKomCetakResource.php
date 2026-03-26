<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanDetMedKomCetakResource\Pages;
use App\Filament\Resources\PermohonanDetMedKomCetakResource\RelationManagers;
use App\Models\AnggaranBelanja;
use App\Models\PermohonanDetMedKomCetak;
use App\Models\Kegiatan;
use App\Models\Layanan;
use App\Models\TitikBaliho;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class PermohonanDetMedKomCetakResource extends Resource
{
    protected static ?string $model = PermohonanDetMedKomCetak::class;

    const LAYANAN_ID = '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1';

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationGroup = 'Permohonan Fasilitasi';
    protected static ?int $navigationSort = 2;

    protected static function getTargetKegiatan(): ?Layanan
    {
        static $kegiatan = null;
        if ($kegiatan === null) {
            $kegiatan = Layanan::find(self::LAYANAN_ID);
        }
        return $kegiatan;
    }

    // Mengganti properti $modelLabel
    public static function getModelLabel(): string
    {
        return static::getTargetKegiatan()?->nama ?? 'Rekap Media Cetak';
    }

    // Mengganti properti $pluralLabel
    public static function getPluralModelLabel(): string
    {
        return static::getModelLabel();
    }

    // Mengganti properti $navigationLabel
    public static function getNavigationLabel(): string
    {
        return static::getModelLabel();
    }

    public static function form(Form $form): Form
    {
        $isBaliho = 'bd7e01de-430d-4336-8774-ed70142171d9';
        $isSpanduk = 'e32537d5-e045-4762-9f8a-70880b52d0bd'; // Ganti sesuai ID Spanduk Anda
        $isFlyer = '9e9e8cf5-d669-4088-bf31-94fdce52779c'; // Ganti sesuai ID Flyer Anda
        $isTabloid = 'cd6d6a81-e472-480b-8bf4-7144c0e75ed7'; // Ganti sesuai ID Tabloid Anda
        return $form
            ->schema([

                Section::make('Detail Konten & Penjadwalan')
                    ->schema([
                        TextInput::make('isi_konten')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        DateRangePicker::make('periode')
                            ->label('Periode Publikasi')
                            ->displayFormat('DD/MM/YYYY')
                            ->format('YYYY-MM-DD')
                            ->required()
                            ->live()
                            ->afterStateHydrated(function ($set, $record) {
                                if ($record && $record->tgl_mulai_publikasi && $record->tgl_selesai_publikasi) {
                                    $formatMulai = Carbon::parse($record->tgl_mulai_publikasi)->format('d/m/Y');
                                    $formatSelesai = Carbon::parse($record->tgl_selesai_publikasi)->format('d/m/Y');
                                    $set('periode', "{$formatMulai} - {$formatSelesai}");
                                }
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state) {
                                    $dates = explode(' - ', $state);
                                    if (count($dates) == 2) {
                                        $set('tgl_mulai_publikasi', Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'));
                                        $set('tgl_selesai_publikasi', Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d'));
                                        // $mulai = Carbon::createFromFormat('Y-m-d', $set('tgl_mulai_publikasi'));
                                        // $selesai = Carbon::createFromFormat('Y-m-d', $set('tgl_selesai_publikasi'));

                                        $mulai = Carbon::createFromFormat('d/m/Y', trim($dates[0]));
                                        $selesai = Carbon::createFromFormat('d/m/Y', trim($dates[1]));
                                        $durasi = $mulai->diffInDays($selesai) + 1;
                                        // dd($durasi);
                                        $set('durasi_hari', $durasi);
                                    } else {
                                        // Jika dikosongkan, reset semua nilai
                                        $set('tgl_mulai_publikasi', null);
                                        $set('tgl_selesai_publikasi', null);
                                        $set('durasi_hari', null);
                                    }
                                }
                            }),
                        TextInput::make('durasi_hari')->numeric()->readOnly(),
                        Hidden::make('tgl_mulai_publikasi')
                            ->required(),
                        Hidden::make('tgl_selesai_publikasi')
                            ->required(),
                        // Hidden::make('volume_hitung')
                        //     ->default('1'),
                        // Hidden::make('jumlah')
                        //     ->default('1'),
                        Hidden::make('kegiatan_id'),
                        Select::make('anggaran_id')
                            ->label('Anggaran Belanja')
                            ->relationship('anggaranBelanja', 'nama', function (Builder $query, $record) {
                                $kegiatanId = $record?->kegiatan_id;
                                $anggaranId = $record?->anggaran_id;
                                return $query
                                    ->where(function (Builder $query) use ($kegiatanId, $anggaranId) {
                                        $query->whereIn('id', [
                                            '1na-1',
                                            $anggaranId, // Tetap tampilkan anggaran yang sudah dipilih meskipun tidak memenuhi syarat lainnya
                                        ])
                                            ->orWhere(function (Builder $query) use ($kegiatanId) {
                                                // Logika: kegiatan_id harus sesuai DAN tahun_anggaran harus aktif
                                                $query->where('kegiatan_id', $kegiatanId)
                                                    ->whereHas('tahunAnggaran', function (Builder $query) {
                                                        $query->where('aktif', 1);
                                                    });
                                            });
                                    });
                            })
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Select::make('titik_baliho_id')
                            ->label('Titik Baliho')
                            ->relationship('titikBaliho', 'nama')
                            ->searchable()
                            ->preload()
                            ->columnSpan(2)
                            ->required()
                            // 1. Tambahkan informasi tambahan (alamat & ukuran) pada dropdown
                            ->getOptionLabelFromRecordUsing(fn(TitikBaliho $record) => "{$record->nama} - {$record->alamat} ({$record->ukuranBaliho?->ukuran_panjang} x {$record->ukuranBaliho?->ukuran_lebar})")

                            // 2. Buat field ini reaktif
                            ->live()

                            // 3. Logika isi otomatis saat dipilih
                            ->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    $titik = TitikBaliho::with('ukuranBaliho')->find($state);
                                    if ($titik && $titik->ukuranBaliho) {
                                        $set('panjang', $titik->ukuranBaliho->ukuran_panjang);
                                        $set('lebar', $titik->ukuranBaliho->ukuran_lebar);
                                    }
                                } else {
                                    // Kosongkan jika pilihan dihapus
                                    $set('panjang', null);
                                    $set('lebar', null);
                                }
                            })
                            ->hidden(fn(Get $get) => $get('kegiatan_id') !== $isBaliho),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('panjang')
                                    ->numeric()
                                    ->readOnly(fn(Get $get) => $get('kegiatan_id') == $isBaliho)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Get $get, Set $set) => self::updateVolume($get, $set))
                                    ->suffix(' m'), // Tambah akhiran meter agar lebih informatif

                                TextInput::make('lebar')
                                    ->numeric()
                                    ->readOnly(fn(Get $get) => $get('kegiatan_id') == $isBaliho)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Get $get, Set $set) => self::updateVolume($get, $set))
                                    ->suffix(' m'),
                            ])->columnSpan(1)
                            ->hidden(fn(Get $get) => $get('kegiatan_id') == $isFlyer || $get('kegiatan_id') == $isTabloid),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('jumlah')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0.5)
                                    ->readOnly(fn(Get $get) => $get('kegiatan_id') == $isBaliho)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Get $get, Set $set) => self::updateVolume($get, $set)),
                                TextInput::make('volume_hitung')
                                    ->numeric()
                                    ->required()
                                    ->readOnly()
                                    ->suffix(fn(Get $get) => match ($get('kegiatan_id')) {
                                        $isBaliho => ' m²',
                                        $isFlyer => ' rim',
                                        $isTabloid => ' buku',
                                        default => ' m²',
                                    })
                                    ->helperText('Otomatis dihitung untuk pemakaian anggaran'),
                            ])
                            ->columnSpan(1)
                            ->hidden(fn(Get $get) => $get('kegiatan_id') == $isBaliho),

                    ])->collapsible()->columns(4),

                Repeater::make('dokumentasi')
                    ->label('Data Dokumentasi')
                    ->relationship('dokumentasi') // Mengacu pada MorphMany di Model
                    ->schema([

                        Grid::make(6)
                            ->schema([
                                TextInput::make('nama')
                                    ->label('Nama Dokumentasi')
                                    ->placeholder('Misal: Foto Pemasangan Sisi Utara')
                                    ->nullable()
                                    ->maxLength(255)
                                    ->columnSpan(2),

                                Select::make('jenis')
                                    ->label('Tahapan/Jenis')
                                    ->options([
                                        'Desain' => 'Desain',
                                        'Publikasi' => 'Publikasi',
                                        'Pelepasan' => 'Pelepasan',
                                    ])
                                    ->required()
                                    ->native(false),
                                //     ]),

                                // Grid::make(2)
                                //     ->schema([
                                DatePicker::make('tanggal_dokumentasi')
                                    ->label('Tanggal Dokumentasi')
                                    ->default(now())
                                    ->required(),

                                FileUpload::make('lokasi_file')
                                    ->label('Unggah Foto')
                                    ->disk('local')
                                    ->maxSize(2048)
                                    ->helperText('Format:PDF. Maks 2MB.')
                                    ->directory('dokumentasi_medkom') // Folder di storage/app/public
                                    ->image()
                                    ->imageEditor()
                                    ->required()
                                    ->visibility('private')
                                    ->storeFileNamesIn('attachment_file_names')
                                    ->columnSpan(2), // Membatasi ukuran file 2MB
                            ]),
                    ])
                    ->itemLabel(fn(array $state): ?string => $state['nama'] ?? 'Dokumentasi Baru')
                    ->collapsible() // Agar form tetap rapi saat data banyak
                    ->defaultItems(0)
                    ->reorderableWithButtons() // Memudahkan penyusunan urutan foto
                    ->columnSpanFull(),


            ]);
    }

    public static function updateVolume(Get $get, Set $set): void
    {
        // Mengambil nilai dari form
        $isBaliho = 'bd7e01de-430d-4336-8774-ed70142171d9';
        $isSpanduk = 'e32537d5-e045-4762-9f8a-70880b52d0bd'; // Ganti sesuai ID Spanduk Anda
        $isFlyer = '9e9e8cf5-d669-4088-bf31-94fdce52779c'; // Ganti sesuai ID Flyer Anda
        $isTabloid = 'cd6d6a81-e472-480b-8bf4-7144c0e75ed7'; // Ganti sesuai ID Tabloid Anda

        $panjang = (float) ($get('panjang') ?? 0);
        $lebar = (float) ($get('lebar') ?? 0);
        $jumlah = (int) ($get('jumlah') ?? 1);
        if ($get('kegiatan_id') == $isBaliho) {
            $total = 1;
        } elseif ($get('kegiatan_id') == $isSpanduk) {
            $total = $panjang * $lebar * $jumlah;
        } elseif ($get('kegiatan_id') == $isFlyer) {
            $total = $jumlah; // Untuk flyer, volume hitung hanya berdasarkan jumlah
        } elseif ($get('kegiatan_id') == $isTabloid) {
            $total = $jumlah; // Untuk tabloid, volume hitung hanya berdasarkan jumlah
        } else {
            $total = 0; // Default untuk jenis kegiatan lain
        }
        $set('volume_hitung', $total);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with([
                'permohonan.instansi',
                'kegiatan',
                'anggaranBelanja',
                'titikBaliho.ukuranBaliho'
            ]))
            ->columns([
                TextColumn::make('permohonan.perihal')
                    ->searchable()
                    ->label('Permohonan')
                    ->description(
                        fn($record) => $record->permohonan->tanggal_surat
                            ? "Tgl: " . \Carbon\Carbon::parse($record->permohonan->tanggal_surat)->format('d/m/Y')
                            : "Tgl: -"
                    )
                    ->wrap(),
                TextColumn::make('permohonan.instansi.nama')
                    ->searchable()
                    ->placeholder('-')
                    ->wrap()
                    ->label('Dari')
                    ->description(
                        fn($record) => $record->permohonan->no_surat
                            ? "No. Surat: " . $record->permohonan->no_surat
                            : "No. Surat: -"
                    ),

                TextColumn::make('konten_ringkas')
                    ->searchable()
                    ->wrap()
                    ->label('Konten')
                    ->getStateUsing(function (PermohonanDetMedKomCetak $record) {
                        return strlen($record->isi_konten) > 50
                            ? substr($record->isi_konten, 0, 50) . '...' . ' (' . ($record->kegiatan?->nama ?? '' . ')')
                            : $record->isi_konten . ' (' . ($record->kegiatan?->nama ?? '') . ')';
                    })
                    ->description(function (PermohonanDetMedKomCetak $record) {
                        $mulai = Carbon::parse($record->tgl_mulai_publikasi)->format('d M');
                        $selesai = Carbon::parse($record->tgl_selesai_publikasi)->format('d M Y');
                        return "{$mulai} - {$selesai} ({$record->durasi_hari} hari)"; // Tampilkan durasi dalam hari
                    }),
                TextColumn::make('keterangan_dinamis')
                    ->label('Detail Teknis / Keterangan')
                    ->getStateUsing(function (PermohonanDetMedKomCetak $record) {
                        return match ($record->kegiatan_id) {
                            // Baliho
                            'bd7e01de-430d-4336-8774-ed70142171d9' => $record->titikBaliho?->nama ?? '-',

                            // Flyer (Ganti UUID sesuai database Anda)
                            '9e9e8cf5-d669-4088-bf31-94fdce52779c' => ($record->volume_hitung ?? '-') . " rim",

                            // Spanduk (Ganti UUID sesuai database Anda)
                            'e32537d5-e045-4762-9f8a-70880b52d0bd' => "{$record->panjang} x {$record->lebar} m",

                            // Tabloid (Ganti UUID sesuai database Anda)
                            'cd6d6a81-e472-480b-8bf4-7144c0e75ed7' => ($record->volume_hitung ?? '-') . " Buku",

                            default => $record->keterangan ?? '-',
                        };
                    })
                    ->description(function (PermohonanDetMedKomCetak $record) {
                        return match ($record->kegiatan_id) {
                            // Deskripsi khusus Baliho
                            'bd7e01de-430d-4336-8774-ed70142171d9' =>
                            "Ukuran: " . ($record->titikBaliho?->ukuranBaliho?->ukuran_panjang ?? '-') .
                                " x " . ($record->titikBaliho?->ukuranBaliho?->ukuran_lebar ?? '-') . " m",

                            // Deskripsi khusus Spanduk (Total Perhitungan)
                            'e32537d5-e045-4762-9f8a-70880b52d0bd' =>
                            "Total: {$record->panjang} x {$record->lebar} x {$record->jumlah} = " . ($record->volume_hitung ?? '0') . " m²",

                            default => null,
                        };
                    })
                    ->wrap()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        // Agar pencarian tetap jalan, kita arahkan ke kolom asli atau relasi
                        return $query->whereHas('titikBaliho', fn($q) => $q->where('nama', 'like', "%{$search}%"))
                            ->orWhere('isi_konten', 'like', "%{$search}%")
                            ->orWhere('keterangan', 'like', "%{$search}%");
                    }),
                TextColumn::make('anggaranBelanja.nama')
                    ->sortable()
                    ->label('Anggaran'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // 1. Filter berdasarkan Jenis Kegiatan (Baliho, Spanduk, dll)
                SelectFilter::make('kegiatan_id')
                    ->label('Jenis Kegiatan')
                    ->relationship('kegiatan', 'nama')
                    ->searchable()
                    ->multiple()
                    ->preload(),

                // 2. Filter berdasarkan Instansi Pengirim
                SelectFilter::make('instansi')
                    ->label('Asal Instansi')
                    ->relationship('permohonan.instansi', 'nama')
                    ->searchable()
                    ->preload(),

                // 4. Filter berdasarkan Rentang Waktu Publikasi (Sangat Berguna untuk Penjadwalan)
                Filter::make('tgl_mulai_publikasi')
                    ->form([
                        DatePicker::make('dari')
                            ->label('Mulai Publikasi'),
                        DatePicker::make('sampai')
                            ->label('Selesai Publikasi'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tgl_mulai_publikasi', '>=', $date),
                            )
                            ->when(
                                $data['sampai'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tgl_mulai_publikasi', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['dari'] ?? null) {
                            $indicators[] = 'Mulai dari: ' . \Carbon\Carbon::parse($data['dari'])->format('d/m/Y');
                        }
                        if ($data['sampai'] ?? null) {
                            $indicators[] = 'Sampai: ' . \Carbon\Carbon::parse($data['sampai'])->format('d/m/Y');
                        }
                        return $indicators;
                    }),
            ])
            ->defaultSort('tgl_mulai_publikasi', 'desc')

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            // ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('exportRekap')
                        ->label('Export Rekap PDF')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (Collection $records) {

                            $namaLayanan = Layanan::where('id', SELF::LAYANAN_ID)->pluck('nama', 'id')->first() ?? 'rekap';


                            $records->load(['dokumentasi', 'kegiatan', 'permohonan.instansi', 'titikBaliho.ukuranBaliho']);

                            $pdf = Pdf::loadView('permohonan.rekap_media_cetak_pdf', ['records' => $records, 'namaLayanan' => $namaLayanan])
                                ->setPaper('a4', 'portrait');

                            return response()->streamDownload(function () use ($pdf) {
                                echo $pdf->stream();
                            }, "Rekap-Fasilitasi-" . date('d-m-Y') . ".pdf");
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermohonanDetMedKomCetaks::route('/'),
            // 'create' => Pages\CreatePermohonanDetMedKomCetak::route('/create'),
            'edit' => Pages\EditPermohonanDetMedKomCetak::route('/{record}/edit'),
        ];
    }
}
