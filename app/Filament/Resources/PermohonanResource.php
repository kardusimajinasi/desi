<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanResource\Pages;
use App\Filament\Resources\PermohonanResource\RelationManagers;
use App\Models\Permohonan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermohonanResource extends Resource
{
    protected static ?string $model = Permohonan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('instansi_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('perihal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('isi_ringkas')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('dengan_surat')
                    ->required()
                    ->maxLength(1),
                Forms\Components\TextInput::make('no_surat')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_surat'),
                Forms\Components\TextInput::make('file_surat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_narahubung')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kontak_narahubung')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instansi_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('perihal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dengan_surat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_surat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_surat')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('file_surat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_narahubung')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kontak_narahubung')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
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
        return [
            //
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
