<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAnggaran extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nama', 'mulai', 'selesai', 'aktif'];

    protected $with = ['AnggaranBelanjas'];

    public function anggaranBelanjas(): HasMany
    {
        return $this->hasMany(AnggaranBelanja::class, 'tahun_anggaran_id');
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
