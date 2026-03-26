<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\UkuranBaliho;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UkuranBalihoResource\Pages;
use App\Filament\Resources\UkuranBalihoResource\RelationManagers;
use Filament\Forms\Components\Select;

class UkuranBalihoResource extends Resource
{
    protected static ?string $model = UkuranBaliho::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Master Layout Baliho';
    protected static ?string $pluralLabel = 'Layout Baliho';
    protected static ?string $modelLabel = 'Layout Baliho';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 23;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([ 
                        TextInput::make('ukuran_panjang')
                            ->required()
                            ->label('Panjang')
                            ->maxLength(10)
                            ->numeric()
                            ->suffix('meter'),
                        TextInput::make('ukuran_lebar')
                            ->required()
                            ->label('Lebar')
                            ->maxLength(10)
                            ->numeric()
                            ->suffix('meter'),
                        Select::make('layout')
                            ->required()
                            ->options([
                                'vertical' => 'Vertical',
                                'horizontal' => 'Horizontal',
                            ]),
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
                Tables\Columns\TextColumn::make('ukuran')
                    ->getStateUsing(function (UkuranBaliho $record) {
                        return $record->ukuran_panjang . ' m x ' . $record->ukuran_lebar . ' m';
                    })
                    ->searchable(),
                // Tables\Columns\TextColumn::make('ukuran_panjang')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('ukuran_lebar')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('layout'),
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
            'index' => Pages\ListUkuranBalihos::route('/'),
            'create' => Pages\CreateUkuranBaliho::route('/create'),
            'edit' => Pages\EditUkuranBaliho::route('/{record}/edit'),
        ];
    }
}
