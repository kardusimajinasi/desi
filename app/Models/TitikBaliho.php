<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TitikBaliho extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nama', 'alamat', 'titik_lokasi', 'ukuran_baliho_id', 'foto_baliho', 'lat', 'lng'];

    protected $with = ['ukuranBaliho'];

    public function ukuranBaliho(): BelongsTo
    {
        return $this->belongsTo(UkuranBaliho::class, 'ukuran_baliho_id');
    }

    // public function permohonanDet(): BelongsTo
    // {
    //     return $this->belongsTo(UkuranBaliho::class, 'ukuran_baliho_id');
    // } 

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        static::deleting(function ($record) {
            // Cek apakah kolom foto_baliho memiliki isi
            if ($record->foto_baliho) {
                // Hapus file dari disk 'public'
                Storage::disk('public')->delete($record->foto_baliho);
            }
        });

        static::updating(function ($record) {
            // Jika kolom foto_baliho berubah (user upload gambar baru)
            if ($record->isDirty('foto_baliho')) {
                // Ambil path gambar yang lama
                $oldImagePath = $record->getOriginal('foto_baliho');

                // Hapus gambar lama dari storage
                if ($oldImagePath) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }
        });
    }
}
