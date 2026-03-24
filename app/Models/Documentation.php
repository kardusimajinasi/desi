<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Documentation extends Model
{
    use HasUuids;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'tanggal_dokumentasi',
        'lokasi_file',
        'jenis',
        'dokumentasiable_type',
        'dokumentasiable_id',
    ];

    /**
     * Relasi MorphTo
     */
    public function documentation(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        static::deleted(function ($model) {
            if ($model->lokasi_file) {
                Storage::disk('local')->delete($model->lokasi_file); // Ubah ke local
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('lokasi_file')) {
                $fileLama = $model->getOriginal('lokasi_file');
                if ($fileLama) {
                    Storage::disk('local')->delete($fileLama); // Ubah ke local
                }
            }
        });
    }
}
