<?php

namespace App\Filament\Widgets;

use App\Models\AnggaranBelanja;
use App\Models\TahunAnggaran; // Pastikan model ini diimport
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DashboardAnggaranTable extends BaseWidget
{
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Detail Sisa Volume Anggaran';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AnggaranBelanja::query()
                    ->whereNotNull('tahun_anggaran_id')
                    ->whereNotNull('volume_awal')
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Item')
                    ->description(fn($record) => "Satuan: {$record->satuan}")
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('volume_awal')
                    ->label('Vol. Awal')
                    ->numeric(decimalPlaces: 2)
                    ->alignRight(),

                    Tables\Columns\TextColumn::make('volume_terpakai')
                    ->label('Vol. Terpakai')
                    ->getStateUsing(function ($record) {
                        // Hitung total volume yang sudah terpakai berdasarkan relasi dengan PermohonanDetMedKomCetak
                        $volumeTerpakai = $record->volume_awal - $record->sisa_volume;
                        return $volumeTerpakai;
                    })
                    ->numeric(decimalPlaces: 2)
                    ->alignRight(),

                Tables\Columns\TextColumn::make('sisa_volume')
                    ->label('Sisa Volume')
                    ->numeric(decimalPlaces: 2)
                    ->alignRight()
                    ->color(fn($state) => $state <= 0 ? 'danger' : 'success')
                    ->weight('black'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y H:i')
                    ->size('xs')
                    ->color('gray'),
            ])
            ->filters([
                SelectFilter::make('tahun_anggaran_id')
                    ->label('Tahun Anggaran')
                    ->options(
                        // Mengambil opsi langsung dari model TahunAnggaran agar lebih bersih
                        TahunAnggaran::query()
                            ->pluck('nama', 'id')
                            ->toArray()
                    )
                    ->default(function () {
                        // LOGIKA DEFAULT: Mengambil ID tahun yang aktif
                        // Ganti 'aktif' atau 'status' sesuai kolom di database Anda
                        return TahunAnggaran::where('aktif', true)
                            ->orWhere('nama', date('Y'))
                            ->first()?->id;
                    })
            ])
            ->defaultSort('updated_at', 'desc')
            ->paginated([5, 10]);
    }
}