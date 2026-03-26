<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Layanan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LayananResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LayananResource\RelationManagers;
use App\Filament\Resources\LayananResource\RelationManagers\KegiatanRelationManager;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Toggle;
use GuzzleHttp\Promise\Create;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Master Layanan';
    protected static ?string $pluralLabel = 'Layanan';
    protected static ?string $modelLabel = 'Layanan';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 22;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([ 
                        TextInput::make('nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('kode_layanan')
                            ->required()
                            ->maxLength(10),
                        Toggle::make('aktif')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columnSpanFull()
                    ->columns(3)
                    ->compact(),   //
            ]) ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id')
                //     ->label('ID')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('aktif')
                    ->label('Aktif')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kode_layanan')
                    ->searchable(), 
            ])
            ->filters([
                //
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make()->modal(), // Opens the create form in a modal
            // ])
            ->actions([
                Tables\Actions\EditAction::make() ,
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            KegiatanRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLayanans::route('/'),
            // 'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}
