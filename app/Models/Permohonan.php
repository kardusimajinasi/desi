<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permohonan extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'instansi_id',
        'perihal',
        'isi_ringkas',
        'dengan_surat',
        'no_surat',
        'tanggal_surat',
        'file_surat',
        'nama_narahubung',
        'kontak_narahubung',
    ];
    // protected $with = ['permohonanDetRunningText', 'permohonanDetMediaKomunikasiCetak', 'permohonanLayanan'];

    // public function permohonanLayanan(): HasMany
    // {
    //     return $this->hasMany(PermohonanLayanan::class, 'permohonan_id');
    // }

    public function permohonanDetMedKomCetak(): HasMany
    {
        return $this->hasMany(PermohonanDetMedKomCetak::class, 'permohonan_id');
    }
    public function permohonanDetMedKomElektronik(): HasMany
    {
        return $this->hasMany(PermohonanDetMedKomElektronik::class, 'permohonan_id');
    }
    // public function detailMediaCetak(): HasMany
    // {
    //     return $this->hasMany(PermohonanDetMediaKomunikasiCetak::class, 'permohonan_id');
    // }
    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }
    

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        static::deleted(function ($model) {
            if ($model->file_surat) {
                Storage::disk('local')->delete($model->file_surat); // Ubah ke local
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('file_surat')) {
                $fileLama = $model->getOriginal('file_surat');
                if ($fileLama) {
                    Storage::disk('local')->delete($fileLama); // Ubah ke local
                }
            }
        });
    }
}
