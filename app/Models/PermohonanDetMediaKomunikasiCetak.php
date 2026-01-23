<?php

namespace App\Models;

use App\Models\TitikBaliho;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\AnggaranBelanja as dokumentasiMediaKomunikasiCetak;

class PermohonanDetMediaKomunikasiCetak extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'permohonan_id',
        'anggaran_id',
        'titik_baliho_id',
        'isi_konten',
        'keterangan',
        'panjang',
        'lebar',
        'jumlah',
        'volume_hitung',
    ];
    protected $with = ['titikBaliho', 'anggaranBelanja', 'permohonan'];

    public function dokumentasiMediaKomunikasiCetak(): HasMany
    {
        return $this->hasMany(DokumentasiMediaKomunikasiCetak::class, 'permohonan_det_id');
    }
    public function titikBaliho(): BelongsTo
    {
        return $this->belongsTo(TitikBaliho::class, 'titik_baliho_id');
    }
    public function anggaranBelanja(): BelongsTo
    {
        return $this->belongsTo(AnggaranBelanja::class, 'anggaran_id');
    }
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
