<?php

namespace App\Filament\Resources\TahunAnggaranResource\RelationManagers;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use App\Models\Layanan;
use App\Models\Kegiatan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class AnggaranBelanjaRelationManager extends RelationManager
{
    protected static string $relationship = 'anggaranBelanja';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('kegiatan_id')
                            ->label('Kegiatan')
                            ->relationship(
                                'kegiatan',
                                'nama',
                                fn(Builder $query) =>
                                $query->where('aktif', 1)->where('dengan_anggaran', 1)
                            )
                            ->required()
                            ->live(onBlur: true) // Memicu update saat user pindah field
                            ->afterStateUpdated(function ($state, $set, $operation) {
                                // Jika sedang 'create', sisa_volume otomatis terisi sama dengan volume_awal
                                if ($operation === 'create') {
                                    // dd(Kegiatan::find($state)?->nama ?? '');
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
                                // if ($operation === 'create') {
                                $set('sisa_volume', $state);
                                // }
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
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['kegiatan.layanan']))
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('kegiatan.layanan.nama')->label('Layanan'),
                Tables\Columns\TextColumn::make('kegiatan.nama')->label('Kegiatan'),
                Tables\Columns\TextColumn::make('volume_awal')->label('Volume'),
                Tables\Columns\TextColumn::make('sisa_volume')->label('Sisa Volume'),
                Tables\Columns\TextColumn::make('satuan'),
            ])
            ->filters([
                SelectFilter::make('layanan')
                    ->label('Filter Layanan')
                    ->relationship('kegiatan.layanan', 'nama')
                    ->query(function (Builder $query, array $data): Builder {
                        // Pada multiple filter, Filament biasanya menggunakan key sesuai nama filter atau 'values'
                        // Kita gunakan logic 'when' agar lebih aman
                        return $query->when(
                            $data['values'] ?? null,
                            fn(Builder $query, $values) => $query->whereHas('kegiatan', function (Builder $query) use ($values) {
                                $query->whereIn('layanan_id', $values);
                            })
                        );
                    })
                    ->multiple()
                    ->searchable()
                    ->preload(),

                // Filter Kegiatan
                SelectFilter::make('kegiatan')
                    ->label('Filter Kegiatan')
                    ->relationship('kegiatan', 'nama')
                    ->searchable()
                    ->preload(),
            ])
            ->defaultSort('nama', 'asc')
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
