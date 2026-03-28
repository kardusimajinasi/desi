<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanDetMedKomElektronikResource\Pages;
use App\Filament\Resources\PermohonanDetMedKomElektronikResource\RelationManagers;
use App\Models\Layanan;
use App\Models\PermohonanDetMedKomElektronik;
use App\Exports\PermohonanElektronikExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Maatwebsite\Excel\Facades\Excel;

class PermohonanDetMedKomElektronikResource extends Resource
{
    protected static ?string $model = PermohonanDetMedKomElektronik::class;

    const LAYANAN_ID = 'c9730c78-1a46-4cf4-b75d-aaaf9fbfda56';

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationGroup = 'Permohonan Fasilitasi';
    protected static ?int $navigationSort = 3;

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
        return static::getTargetKegiatan()?->nama ?? 'Rekap Media Elektronik';
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
        $isRunningText = '76a8d937-6879-4f36-91af-4bef7c8771ce';
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

                        Grid::make(2)
                            ->schema([
                                TextInput::make('volume_hitung')
                                    ->numeric()
                                    ->required()
                                    ->label('Jumlah')
                                    ->suffix('Tampilan')
                            ])
                            ->columnSpan(1),
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

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->with([
                'permohonan.instansi',
                'kegiatan',
                'anggaranBelanja',
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
                    ->getStateUsing(function (PermohonanDetMedKomElektronik $record) {
                        return strlen($record->isi_konten) > 50
                            ? substr($record->isi_konten, 0, 50) . '...' . ' (' . ($record->kegiatan?->nama ?? '' . ')')
                            : $record->isi_konten . ' (' . ($record->kegiatan?->nama ?? '') . ')';
                    })
                    ->description(function (PermohonanDetMedKomElektronik $record) {
                        $mulai = Carbon::parse($record->tgl_mulai_publikasi)->format('d M');
                        $selesai = Carbon::parse($record->tgl_selesai_publikasi)->format('d M Y');
                        return "{$mulai} - {$selesai} ({$record->durasi_hari} hari)"; // Tampilkan durasi dalam hari
                    }),
                TextColumn::make('keterangan_dinamis')
                    ->label('Detail Teknis / Keterangan')
                    ->getStateUsing(function (PermohonanDetMedKomElektronik $record) {
                        return match ($record->kegiatan_id) {
                            // Baliho
                            '76a8d937-6879-4f36-91af-4bef7c8771ce' => ($record->volume_hitung ?? '-') . " Tampilan",
                            default => $record->keterangan ?? '-',
                        };
                    })
                    ->description(function (PermohonanDetMedKomElektronik $record) {
                        return match ($record->kegiatan_id) {
                            default => null,
                        };
                    })
                    ->wrap()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        // Agar pencarian tetap jalan, kita arahkan ke kolom asli atau relasi
                        return $query->orWhere('isi_konten', 'like', "%{$search}%")
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
                        ->color('warning')
                        ->action(function (Collection $records) {

                            $namaLayanan = Layanan::where('id', SELF::LAYANAN_ID)->pluck('nama', 'id')->first() ?? 'rekap';


                            $records->load(['dokumentasi', 'kegiatan', 'permohonan.instansi']);

                            $pdf = Pdf::loadView('permohonan.rekap_media_elektronik_pdf', ['records' => $records, 'namaLayanan' => $namaLayanan])
                                ->setPaper('a4', 'portrait');

                            return response()->streamDownload(function () use ($pdf) {
                                echo $pdf->stream();
                            }, "Rekap-Fasilitasi-" . date('d-m-Y') . ".pdf");
                        })
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('exportRekapExcel')
                        ->label('Export Rekap Excel')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (Collection $records) {

                            $namaLayanan = Layanan::where('id', SELF::LAYANAN_ID)->pluck('nama', 'id')->first() ?? 'rekap';


                            $records->load(['dokumentasi', 'kegiatan', 'permohonan.instansi']);
                            return Excel::download(
                                new PermohonanElektronikExport($records, $namaLayanan),
                                'Rekap-Publikasi-Elektronik-' . now()->format('d-m-Y') . '.xlsx'
                            );
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
            'index' => Pages\ListPermohonanDetMedKomElektroniks::route('/'),
            // 'create' => Pages\CreatePermohonanDetMedKomElektronik::route('/create'),
            'edit' => Pages\EditPermohonanDetMedKomElektronik::route('/{record}/edit'),
        ];
    }
}
