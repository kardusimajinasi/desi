<?php

namespace App\Filament\Resources\PermohonanResource\RelationManagers;

use App\Models\AnggaranBelanja;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;
use App\Models\PermohonanDetMedKomCetak;
use App\Models\TitikBaliho;
use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Grid;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class DetailMedCetakBalihoRelationManager extends RelationManager
{
    protected static string $relationship = 'permohonanDetMedKomCetak';
    const KEGIATAN_ID = 'bd7e01de-430d-4336-8774-ed70142171d9';
    protected static function getTargetKegiatan(): ?Kegiatan
    {
        static $kegiatan = null;

        if ($kegiatan === null) {
            $kegiatan = Kegiatan::find(self::KEGIATAN_ID);
        }

        return $kegiatan;
    }

    public static function getModelLabel(): string
    {
        return static::getTargetKegiatan()?->nama ?? 'Baliho';
    }

    public static function getPluralModelLabel(): string
    {
        return static::getModelLabel();
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return static::getModelLabel();
    }

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return static::getTargetKegiatan()->aktif == 1;
        // return true;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('isi_konten')
                    ->required()
                    ->maxLength(255),
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
                Hidden::make('volume_hitung')
                    ->default('1'),
                Hidden::make('jumlah')
                    ->default('1'),
                Hidden::make('kegiatan_id')
                    ->default(self::KEGIATAN_ID), // Set default ke ID Kegiatan Running Text
                Select::make('anggaran_id')
                    ->label('Anggaran Belanja')
                    ->relationship('anggaranBelanja', 'nama', function (Builder $query, $record) {
                        $kegiatanId = $record?->kegiatan_id ?? self::KEGIATAN_ID;
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
                    ->nullable()
                    ->hidden(static::getTargetKegiatan()->dengan_anggaran != 1),
                Select::make('titik_baliho_id')
                    ->label('Titik Baliho')
                    ->relationship('titikBaliho', 'nama')
                    ->searchable()
                    ->preload()
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
                    }),

                Grid::make(2)
                    ->schema([
                        TextInput::make('panjang')
                            ->numeric()
                            ->readOnly()
                            ->suffix(' m'), // Tambah akhiran meter agar lebih informatif

                        TextInput::make('lebar')
                            ->numeric()
                            ->readOnly()
                            ->suffix(' m'),
                    ])->columnSpan(1),
            ]);
    }

    protected function updateSisaAnggaran(?string $anggaranId): void
    {
        if (!$anggaranId || $anggaranId == '1na-1') return;

        $anggaran = AnggaranBelanja::find($anggaranId);
        if (!$anggaran) return;
        $totalPenggunaan = PermohonanDetMedKomCetak::where('anggaran_id', $anggaranId)
            ->sum('volume_hitung');
        $anggaran->update([
            'sisa_volume' => $anggaran->volume_awal - $totalPenggunaan
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn(Builder $query) => $query
                    ->where('kegiatan_id', self::KEGIATAN_ID)
                    ->with(['titikBaliho.ukuranBaliho', 'anggaranBelanja']) // Eager loading di sini
            )
            ->recordTitleAttribute('isi_konten')
            ->columns([
                TextColumn::make('isi_konten')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('periode')
                    ->label('Periode Publikasi')
                    ->getStateUsing(function (PermohonanDetMedKomCetak $record) {
                        $mulai = Carbon::parse($record->tgl_mulai_publikasi)->format('d M');
                        $selesai = Carbon::parse($record->tgl_selesai_publikasi)->format('d M Y');
                        return "{$mulai} - {$selesai} ({$record->durasi_hari} hari)"; // Tampilkan durasi dalam hari
                    })
                    ->sortable(),
                TextColumn::make('titikBaliho.nama')
                    ->label('Titik Baliho')
                    ->description(function (PermohonanDetMedKomCetak $record) {
                        $panjang = $record->titikBaliho?->ukuranBaliho?->ukuran_panjang ?? '-';
                        $lebar = $record->titikBaliho?->ukuranBaliho?->ukuran_lebar ?? '-';
                        return "Ukuran: {$panjang} x {$lebar} m";
                    })
                    ->searchable()
                    ->wrap(),
                TextColumn::make('anggaranBelanja.nama')
                    ->label('Anggaran'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function ($record) {
                        $this->updateSisaAnggaran($record->anggaran_id);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function ($record) {
                        $idBaru = $record->anggaran_id;
                        $idLama = $record->getPrevious('anggaran_id')['anggaran_id'] ?? null;
                        if ($idBaru) {
                            $this->updateSisaAnggaran($idBaru);
                        }
                        if ($idLama && $idLama !== $idBaru) {
                            $this->updateSisaAnggaran($idLama);
                        }
                    }),
                Tables\Actions\DeleteAction::make()
                    ->after(function ($record) {
                        $this->updateSisaAnggaran($record->anggaran_id);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
