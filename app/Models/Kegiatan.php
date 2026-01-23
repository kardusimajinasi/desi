<?php

namespace App\Models;

use App\Models\Layanan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kegiatan extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nama',
        'dengan_anggaran',
        'layanan_id',
        'aktif',
    ];

    protected $with = ['layanan'];

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
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
