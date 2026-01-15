<?php

namespace App\Filament\Resources\TahunAnggaranResource\RelationManagers;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use App\Models\Kegiatan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AnggaranBelanjasRelationManager extends RelationManager
{
    protected static string $relationship = 'anggaranBelanjas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('kegiatan_id')
                            ->label('Kegiatan')
                            ->relationship('kegiatans', 'nama')
                            ->required()
                            ->afterStateUpdated(function ($state, $set, $operation) {
                                // Jika sedang 'create', sisa_volume otomatis terisi sama dengan volume_awal
                                if ($operation === 'create') {
                                    $set('nama', Kegiatan::find($state)?->nama ?? '');
                                }
                            }),
                        TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('volume_awal')
                            ->numeric()
                            ->label('Volume')
                            ->minValue(0)
                            ->required()
                            ->live(onBlur: true) // Memicu update saat user pindah field
                            ->afterStateUpdated(function ($state, $set, $operation) {
                                // Jika sedang 'create', sisa_volume otomatis terisi sama dengan volume_awal
                                if ($operation === 'create') {
                                    $set('sisa_volume', $state);
                                }
                            }),
                        TextInput::make('satuan')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('sisa_volume')
                            ->numeric()
                            ->label('Sisa Volume')
                            ->helperText('Otomatis mengikuti Volume saat pembuatan baru.')
                            ->readOnly() // Jangan biarkan user edit manual agar saldo tetap akurat
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->columns(4)
                    ->compact(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('nama'),
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
