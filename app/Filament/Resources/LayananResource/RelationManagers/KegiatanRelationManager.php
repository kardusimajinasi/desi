<?php

namespace App\Filament\Resources\LayananResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class KegiatanRelationManager extends RelationManager
{
    protected static string $relationship = 'kegiatans';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([ 
                        TextInput::make('nama')
                            ->required()
                            ->maxLength(255), 
                        Toggle::make('dengan_anggaran')
                            ->label('Dengan Anggaran')
                            ->default(true),
                        Toggle::make('aktif')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columnSpanFull()
                    ->columns(3) 
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\IconColumn::make('dengan_anggaran')
                    ->boolean(),
                Tables\Columns\IconColumn::make('aktif')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
