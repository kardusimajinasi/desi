<?php

namespace App\Filament\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TahunAnggaran;
use App\Models\AnggaranBelanja;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TahunAnggaranResource\Pages;
use App\Filament\Resources\TahunAnggaranResource\RelationManagers;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;
use App\Filament\Resources\TahunAnggaranResource\RelationManagers\AnggaranBelanjaRelationManager;

class TahunAnggaranResource extends Resource
{
    // protected static ?string $model = TahunAnggaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Anggaran';
    protected static ?string $pluralLabel = 'Anggaran';
    protected static ?string $modelLabel = 'Anggaran';
    protected static ?string $navigationGroup = 'Pembaruan Tahunan';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        DateRangePicker::make('periode')
                            ->label('Periode Anggaran')
                            ->displayFormat('DD/MM/YYYY')
                            ->format('YYYY-MM-DD')
                            ->required()
                            ->live()
                            ->afterStateHydrated(function ($set, $record) {
                                if ($record && $record->mulai && $record->selesai) {
                                    $formatMulai = Carbon::parse($record->mulai)->format('d/m/Y');
                                    $formatSelesai = Carbon::parse($record->selesai)->format('d/m/Y');
                                    $set('periode', "{$formatMulai} - {$formatSelesai}");
                                }
                            })
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state) {
                                    $dates = explode(' - ', $state);
                                    if (count($dates) == 2) {
                                        $set('mulai', Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'));
                                        $set('selesai', Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d'));
                                    }
                                }
                            }),
                        Hidden::make('mulai')
                            ->required(),
                        Hidden::make('selesai')
                            ->required(),
                        Toggle::make('aktif')
                            ->label('Aktif')
                            ->default(true),
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
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('periode')
                    ->label('Periode Anggaran')
                    ->getStateUsing(function (TahunAnggaran $record) {
                        // $mulai = Carbon::parse($record->mulai)->format('d/m/Y');
                        // $selesai = Carbon::parse($record->selesai)->format('d/m/Y');
                        $mulai = Carbon::parse($record->mulai)->format('d/m/Y');
                        $selesai = Carbon::parse($record->selesai)->format('d/m/Y');
                        return "{$mulai} - {$selesai}";
                    })
                    ->sortable(), 
                IconColumn::make('aktif')
                    ->boolean(),
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
            ->defaultSort('nama', 'desc')
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
            AnggaranBelanjaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTahunAnggarans::route('/'),
            'create' => Pages\CreateTahunAnggaran::route('/create'),
            'edit' => Pages\EditTahunAnggaran::route('/{record}/edit'),
        ];
    }
}
