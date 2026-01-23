<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TitikBaliho;
use App\Models\UkuranBaliho;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TitikBalihoResource\Pages;
use App\Filament\Resources\TitikBalihoResource\RelationManagers;
use App\Filament\Resources\TitikBalihoResource\Widgets\BalihoMap;

class TitikBalihoResource extends Resource

{
    protected static ?string $model = TitikBaliho::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Lokasi Baliho';
    protected static ?string $pluralLabel = 'Lokasi Baliho';
    protected static ?string $modelLabel = 'Lokasi Baliho';
    protected static ?string $navigationGroup = 'Pembaruan Tahunan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('alamat')
                            ->required()
                            ->maxLength(500),
                        Select::make('ukuran_baliho_id')
                            ->required()
                            ->relationship('ukuranBaliho', 'ukuran_panjang') // Tetap butuh 1 kolom default
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->ukuran_panjang} x {$record->ukuran_lebar} ({$record->layout})"),
                        TextInput::make('titik_lokasi')
                            ->required()
                            ->url()
                            ->helperText('Masukkan URL lokasi peta (Google Maps atau lainnya).')
                            ->maxLength(255),
                        TextInput::make('lat')
                            ->required()
                            ->helperText('Masukkan koordinat lintang (latitude) lokasi baliho.')
                            ->maxLength(50),
                        TextInput::make('lng')
                            ->required()
                            ->helperText('Masukkan koordinat bujur (longitude) lokasi baliho.')
                            ->maxLength(50),
                        FileUpload::make('foto_baliho')
                            // ->image()
                            // ->maxSize(2048),
                            // ->label('Foto Baliho')
                            ->image()
                            ->helperText('Format file: .jpg, .jpeg, .png. Maksimal ukuran file: 5MB.')
                            ->disk('public')
                            ->required()
                            ->directory('baliho')
                            ->visibility('public')
                            // ->imagePreviewHeight('100')
                            ->loadingIndicatorPosition('left')
                            ->downloadable(false)
                            ->openable(false)
                            // ->previewable(false)
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/png', 'image/jpeg']),
                    ])
                    ->columnSpanFull()
                    ->columns(3)
                    ->compact(),   // 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->label('ID')
                //     ->searchable(),

                // Tables\Columns\TextColumn::make('nama')
                //     ->searchable()
                //     ->wrap(),
                // Tables\Columns\TextColumn::make('alamat')
                //     ->searchable()
                //     ->wrap(),
                // Split::make([
                //     Tables\Columns\TextColumn::make('ukuran')
                //         ->getStateUsing(function (TitikBaliho $record) {
                //             return $record->ukuranBaliho->ukuran_panjang . ' m x ' . $record->ukuranBaliho->ukuran_lebar . ' m';
                //         })
                //         ->searchable()
                //         ->grow(false),
                //     Tables\Columns\TextColumn::make('ukuranBaliho.layout')
                //         ->badge() // Opsional: buat jadi badge agar menarik
                //         ->color('info')
                //         ->searchable()
                //         ->grow(false),
                // ])->,
                // Tables\Columns\TextColumn::make('titik_lokasi')
                //     ->searchable()
                //     ->wrap()
                //     ->limit(50), 
                // Tables\Columns\ImageColumn::make('foto_baliho')
                //     ->label('Foto')
                //     ->disk('public')
                //     ->size(90)
                //     ->square()
                //     ->extraAttributes(['class' => 'cursor-pointer'])
                //     ->action(
                //         Action::make('preview')
                //             ->modal()
                //             ->modalHeading('Preview Foto Baliho')
                //             ->modalContent(fn(TitikBaliho $record) => view('filament.balihos._preview', [
                //                 'record' => $record,
                //             ]))
                //             ->modalSubmitAction(false)
                //             ->modalCancelActionLabel('Close')
                //     ), 

                // TextColumn::make('created_at')
                //             ->dateTime()
                //             ->sortable()
                //             ->toggleable(isToggledHiddenByDefault: true),
                //         TextColumn::make('updated_at')
                //             ->dateTime()
                //             ->sortable()
                //             ->toggleable(isToggledHiddenByDefault: true),
                Split::make([

                    // BAGIAN TENGAH: Nama, Alamat, Ukuran (Menumpuk)
                    Stack::make([
                        TextColumn::make('nama')
                            ->weight('bold')
                            ->searchable(),


                        // Baris Ukuran & Badge Layout
                    ])->space(2), // Jarak antar baris teks
                    Stack::make([
                        TextColumn::make('alamat')
                            ->size('sm')
                            ->limit(70)
                            ->searchable()
                            ->color('gray'),
                        TextColumn::make('ukuran_formatted')
                            ->getStateUsing(fn($record) => "{$record->ukuranBaliho?->ukuran_panjang}m x {$record->ukuranBaliho?->ukuran_lebar}m")
                            ->size('xs'),

                        TextColumn::make('ukuranBaliho.layout')
                            ->badge()
                            ->color(fn($record) => match ($record->ukuranBaliho?->layout) {
                                'horizontal' => 'success',
                                'vertical' => 'warning',
                                default => 'primary',
                            })
                            ->size('xs'),
                    ])->space(1), // Jarak tipis antara ukuran dan badge

                    ImageColumn::make('foto_baliho')
                        // ->circular()
                        ->grow(false)
                        ->size(90)
                        ->extraAttributes(['class' => 'cursor-pointer'])
                        ->action(
                            Action::make('preview')
                                ->modal()
                                ->modalHeading('Preview Foto Baliho')
                                ->modalContent(fn(TitikBaliho $record) => view('filament.balihos._preview', [
                                    'record' => $record,
                                ]))
                                ->modalSubmitAction(false)
                                ->modalCancelActionLabel('Close')
                        ),

                    // BAGIAN KANAN: Informasi Tambahan (Maps/Tanggal)
                    // Stack::make([

                    // TextColumn::make('titik_lokasi')
                    //     ->label('Lokasi')
                    //     ->icon('heroicon-m-map-pin')
                    //     ->formatStateUsing(fn() => 'Lihat Rute')
                    //     // ->url(fn ($state) => $state, true)
                    //     ->alignEnd(), // Rata kanan

                    // TextColumn::make('created_at')
                    //     ->dateTime('d M Y')
                    //     ->size('xs')
                    //     ->color('gray')
                    //     ->alignEnd(),
                    // ]), // Hanya muncul di layar komputer/tablet
                    // Stack::make([ 
                    //     TextColumn::make('created_at')
                    //         ->dateTime()
                    //         ->sortable()
                    //         ->toggleable(isToggledHiddenByDefault: true),
                    //     TextColumn::make('updated_at')
                    //         ->dateTime()
                    //         ->sortable()
                    //         ->toggleable(isToggledHiddenByDefault: true),
                    // ])
                    // ->label('Log Waktu')
                    // ->toggleable(isToggledHiddenByDefault: true),
                ]),

            ])
            // ->contentGrid([
            //     'md' => 2, // Tetap 1 baris penuh agar terlihat seperti list di gambar kedua
            // ])
            ->filters([
                SelectFilter::make('ukuran_baliho_id')
                    ->relationship('ukuranBaliho', 'ukuran_panjang')
                    ->label('Ukuran Baliho')
                    ->multiple()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->ukuran_panjang} x {$record->ukuran_lebar} ({$record->layout})")
                    ->indicateUsing(function (array $data): array {
                        if (! $data['values']) {
                            return [];
                        }

                        // Ambil data dari database berdasarkan ID yang dipilih untuk mendapatkan label lengkap
                        $labels = \App\Models\UkuranBaliho::whereIn('id', $data['values'])
                            ->get()
                            ->map(fn($record) => "{$record->ukuran_panjang} x {$record->ukuran_lebar} ({$record->layout})")
                            ->toArray();

                        return ['Ukuran: ' . implode(', ', $labels)];
                    }),
            ])
            ->toggleColumnsTriggerAction(
                fn(Action $action) => $action->label('Atur Kolom')
            )
            ->defaultSort('nama', 'desc')
            ->actions([
                Tables\Actions\Action::make('lihat_rute')
                    ->label('Lihat Rute') // Tetap beri label untuk aksesibilitas (tooltip)
                    ->icon('heroicon-m-map-pin')
                    ->color('success')
                    // ->iconButton() // Mengubah teks menjadi tombol ikon saja
                    ->url(fn($record) => $record->titik_lokasi, true),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListTitikBalihos::route('/'),
            'create' => Pages\CreateTitikBaliho::route('/create'),
            'edit' => Pages\EditTitikBaliho::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BalihoMap::class, // Sesuaikan dengan namespace widget Anda
        ];
    }
}
