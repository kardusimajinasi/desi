<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanResource\Pages;
use App\Filament\Resources\PermohonanResource\RelationManagers;
use App\Filament\Resources\PermohonanResource\RelationManagers\DetailMedElektronikRnTxtRelationManager;
use App\Filament\Resources\PermohonanResource\RelationManagers\DetailRunningTextRelationManager;
use App\Filament\Resources\PermohonanResource\RelationManagers\DetailMedCetakBalihoRelationManager;
use App\Filament\Resources\PermohonanResource\RelationManagers\DetailMedCetakSpandukRelationManager;
use App\Filament\Resources\PermohonanResource\RelationManagers\DetailMedCetakFlyerRelationManager;
use App\Filament\Resources\PermohonanResource\RelationManagers\DetailMedCetakTabloidRelationManager;
use App\Models\Instansi;
use App\Models\Kegiatan;
use App\Models\Layanan;
use App\Models\Permohonan;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Hugomyb\FilamentMediaAction\Tables\Actions\MediaAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermohonanResource extends Resource
{
    protected static ?string $model = Permohonan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';
    protected static ?string $navigationLabel = 'Permohonan';
    protected static ?string $pluralLabel = 'Permohonan';
    protected static ?string $modelLabel = 'Permohonan';
    protected static ?string $navigationGroup = 'Permohonan Fasilitasi';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section 1: Data Utama (Gunakan Grid agar lebih rapi)
                Section::make('Informasi Permohonan')
                    ->description('Lengkapi data instansi dan detail perihal permohonan.')
                    ->schema([
                        Select::make('instansi_id')
                            ->label('Instansi')
                            ->relationship('instansi', 'nama')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->live() // Membuat field ini reaktif secara instan (pengganti reactive())
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Ambil data instansi dari database
                                $instansi = Instansi::find($state);

                                // Jika instansi adalah swasta, paksa toggle "dengan_surat" menjadi true (Ya)
                                if ($instansi && strtolower($instansi->kategori) === 'swasta') {
                                    $set('dengan_surat', true);
                                } else {
                                    $set('dengan_surat', false);
                                }
                            })
                            ->columnSpan([
                                'default' => 3,
                                'md' => 1,
                            ]),
                        TextInput::make('perihal')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('tanggal_surat')
                            ->label('Tanggal Surat/ Permohonan')
                            ->native(false) // UI lebih modern
                            ->displayFormat('d/m/Y')
                            ->required()
                            ->visible(),
                        Textarea::make('isi_ringkas')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(3),

                // Menggunakan Grid/Split untuk membagi Narahubung dan Data Surat
                Forms\Components\Grid::make(2)
                    ->schema([
                        // Section 2: Narahubung
                        Section::make('Narahubung')
                            ->schema([
                                TextInput::make('nama_narahubung')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('kontak_narahubung')
                                    ->label('No. WhatsApp/Telp')
                                    ->required()
                                    ->tel()
                                    ->maxLength(255),
                            ])->columnSpan(1),

                        // Section 3: Data Surat
                        Section::make('Dokumen Surat')
                            ->schema([
                                Toggle::make('dengan_surat')
                                    ->required()
                                    ->live() // Memantau perubahan toggle secara real-time
                                    ->dehydrated(true),
                                TextInput::make('no_surat')
                                    ->required(fn(callable $get) => $get('dengan_surat'))
                                    ->visible(fn(callable $get) => $get('dengan_surat'))
                                    ->columnSpan(2),

                                FileUpload::make('file_surat')
                                    // ->image()
                                    ->disk('local')
                                    ->directory('surat_permohonan')
                                    ->maxSize(5120)
                                    ->acceptedFileTypes(['application/pdf']) // Tambahkan PDF
                                    ->helperText('Format:PDF. Maks 5MB.')
                                    ->columnSpanFull()
                                    ->required(fn(callable $get) => $get('dengan_surat'))
                                    ->visible(fn(callable $get) => $get('dengan_surat')),
                            ])->columns(3)->columnSpan(1),
                    ]),
            ]);
        // return $form
        //     ->schema([
        //         Split::make([



        //             Section::make([
        //                 Select::make('instansi_id')
        //                     ->label('Instansi')
        //                     ->relationship('instansi', 'nama')
        //                     ->required()
        //                     ->searchable()
        //                     ->preload(),
        //                 TextInput::make('perihal')
        //                     ->required()
        //                     ->maxLength(255),
        //                 Textarea::make('isi_ringkas')
        //                     ->required()
        //                     ->columnSpan(2),

        //                 TextInput::make('nama_narahubung')
        //                     ->required()
        //                     ->maxLength(255),
        //                 TextInput::make('kontak_narahubung')
        //                     ->required()
        //                     ->tel()
        //                     ->maxLength(255),
        //                 // Toggle::make('aktif')
        //                 //     ->label('Aktif')
        //                 //     ->default(true),
        //             ])->columnSpanFull()
        //                 ->columns(4)
        //                 ->compact(),
        //             Section::make([
        //                 TextInput::make('dengan_surat')
        //                     ->required()
        //                     ->maxLength(255),
        //                 TextInput::make('no_surat')
        //                     ->required()
        //                     ->maxLength(255),
        //                 DatePicker::make('tanggal_surat')
        //                     ->required(),
        //                 FileUpload::make('file_surat')
        //                     // ->image()
        //                     // ->maxSize(2048),
        //                     // ->label('Foto Baliho')
        //                     ->image()
        //                     ->helperText('Format file: .jpg, .jpeg, .png. Maksimal ukuran file: 5MB.')
        //                     ->disk('public')
        //                     ->required()
        //                     ->directory('surat_permohonan')
        //                     ->visibility('public')
        //                     // ->imagePreviewHeight('100')
        //                     ->loadingIndicatorPosition('left')
        //                     ->downloadable(false)
        //                     ->openable(false)
        //                     // ->previewable(false)
        //                     ->maxSize(5120)
        //                     ->acceptedFileTypes(['image/png', 'image/jpeg']),
        //             ])->grow(false),
        //         ]),



        //     ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('instansi.nama')
                    ->label('Instansi')
                    // Menggunakan optional() agar tidak error jika instansi tiba-tiba kosong
                    ->description(fn($record) => optional($record->instansi)->kategori ?? '-')
                    ->searchable(),

                TextColumn::make('perihal')
                    // ->limit(30)
                    ->wrap()
                    ->searchable(), // Tambahkan searchable agar perihal bisa dicari

                TextColumn::make('no_surat')
                    ->label('No. Surat')
                    ->default('-')
                    // HAPUS ->date() di sini karena no_surat bukan kolom tanggal
                    ->description(
                        fn($record) => $record->tanggal_surat
                            ? "Tgl: " . \Carbon\Carbon::parse($record->tanggal_surat)->format('d/m/Y')
                            : "Tgl: -"
                    )
                    ->searchable(),
                // TextColumn::make('tanggal_surat')
                //     ->date('d/m/Y')
                //     ->label('Tgl Surat'),

                // Badge status untuk membedakan kategori


                IconColumn::make('file_surat')
                    ->label('File Surat') // Judul kolom yang Anda butuhkan
                    ->icon('heroicon-o-document')
                    ->alignCenter()
                    ->color('primary')
                    // ->icon('heroicon-o-document-magnifying-glass')
                    // ->iconColor('primary')
                    // ->description('Klik untuk lihat') // Opsional: teks tambahan di bawah ikon
                    // ->formatStateUsing(fn() => '') // Menghilangkan teks nama file agar hanya ikon yang tampil
                    ->action(
                        MediaAction::make('view_file') // Pemicu modal
                            ->media(
                                function ($record) {
                                    // Pastikan file_surat tidak null sebelum memproses route
                                    if (! $record->file_surat) {
                                        return route('surat.private', [
                                            // Gunakan basename hanya jika file ada
                                            'path' => basename('kosong.pdf')
                                        ]);
                                    }

                                    return route('surat.private', [
                                        // Gunakan basename hanya jika file ada
                                        'path' => basename($record->file_surat)
                                    ]);
                                }
                            )
                            ->modalHeading(fn($record) => "Dokumen: " . $record->no_surat)
                            ->modalWidth('5xl')
                    )
                //  ->visible(fn ($record) => $record->file_surat !== null)
                ,

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
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([

                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        try {
            $namaLayanan = Layanan::whereIn('id', ['c9730c78-1a46-4cf4-b75d-aaaf9fbfda56', '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1'])->pluck('nama', 'id')->toArray();
        } catch (\Exception $e) {
            $namaLayanan = [
                'c9730c78-1a46-4cf4-b75d-aaaf9fbfda56' => 'Layanan 1',
                '0c2ce546-aa59-4f23-8954-a03bcf5f5bb1' => 'Layanan 2',
            ];
        }
        return [
            RelationGroup::make($namaLayanan['c9730c78-1a46-4cf4-b75d-aaaf9fbfda56'], [
                DetailMedElektronikRnTxtRelationManager::class,
            ]),
            RelationGroup::make($namaLayanan['0c2ce546-aa59-4f23-8954-a03bcf5f5bb1'], [
                DetailMedCetakBalihoRelationManager::class,
                DetailMedCetakSpandukRelationManager::class,
                DetailMedCetakFlyerRelationManager::class,
                DetailMedCetakTabloidRelationManager::class,
            ]),

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermohonans::route('/'),
            'create' => Pages\CreatePermohonan::route('/create'),
            'edit' => Pages\EditPermohonan::route('/{record}/edit'),
        ];
    }
}
