<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Concerns\SoftDeletes;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\SuffixAction;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'User';
    protected static ?string $pluralLabel = 'User';
    protected static ?string $navigationGroup = 'Akun';
    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('telepon')
                    ->label('Nomor Telepon')
                    ->required()
                    ->maxLength(20)
                    ->tel() // ini ada, untuk input type="tel"
                    ->placeholder('08xxxxxxxxxx')
                    ->rules(['regex:/^[0-9]+$/']), // hanya angka

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->required(fn(string $context) => $context === 'create')
                    ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                    ->maxLength(255)
                    ->rules([
                        'required',
                        'min:6',
                        'regex:/[a-z]/',
                        'regex:/[A-Z]/',
                        'regex:/[0-9]/',
                        'regex:/[\W]/',
                    ])
                    ->hint('Minimal 6 karakter, 1 huruf besar, 1 huruf kecil, 1 angka, 1 simbol'),

                Forms\Components\Select::make('instansi_id')
                    ->label('Instansi')
                    ->relationship('instansi', 'instansi') // relasi + kolom yang ditampilkan
                    ->searchable() // ini bikin mirip select2
                    ->preload() // optional: load semua opsi di awal
                    ->required()
                    ->placeholder('Pilih Instansi'),

                TextInput::make('password_confirmation')
                    ->label('Konfirmasi Password')
                    ->password()
                    ->revealable()
                    ->required(fn(string $context) => $context === 'create')
                    ->dehydrated(false)
                    ->same('password'),

                Forms\Components\Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name') // dari spatie
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\FileUpload::make('foto_profil')
                    ->label('Upload Foto Profil')
                    ->image()
                    ->disk('public')
                    ->directory('profil')
                    ->preserveFilenames()
                    ->previewable()
                    ->imagePreviewHeight('100')
                    ->loadingIndicatorPosition('left')
                    ->downloadable(false)
                    ->openable(false)
                    ->previewable(true)
                    ->maxSize(5120)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah User')
                    ->modalHeading('Tambah User')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->disableCreateAnother(),
            ])
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('foto_profil')
                    ->label('Foto')
                    ->disk('public')
                    ->height(48)
                    ->width(48)
                    ->square()
                    ->action(
                        Tables\Actions\Action::make('preview')
                            ->label('Lihat Foto')
                            ->icon('heroicon-o-eye')
                            ->modalHeading('Foto Profil')
                            ->modalButton('Tutup')
                            ->modalContent(function ($record) {
                                $foto = $record->foto_profil
                                    ? asset('storage/' . $record->foto_profil)
                                    : asset('images/default-avatar.png');
                                return view('components.foto-preview', ['foto' => $foto]);
                            })
                    ),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->separator(', '),

                TextColumn::make('instansi.instansi')
                    ->label('Nama Instansi')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            // ->actions([
            //     Tables\Actions\EditAction::make(),
            //     Tables\Actions\DeleteAction::make()
            //         ->label('Hapus'),
            // ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn($record) => auth()->user()?->hasRole('') || auth()->id() === $record->id),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn() => auth()->user()?->hasRole('')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getModel(): string
    {
        return \App\Models\User::class;
    }

    public static function getRecordRouteKeyName(): string
    {
        return 'id';
    }

    // public static function canViewAny(): bool
    // {
    // return auth()->user()?->hasRole('Raja');
    // }

}
