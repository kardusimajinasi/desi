<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggaranBelanja extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['tahun_anggaran_id', // Field baru
                            'kegiatan_id',       // Nama baru
                            'volume_awal', 
                            'satuan', 
                            'nama', 
                            'sisa_volume'];

    protected $with = ['tahunAnggarans', 'kegiatan'];

    public function tahunAnggarans(): BelongsTo
    {
        return $this->belongsTo(TahunAnggaran::class, 'tahun_anggaran_id');
    }

    public function kegiatans(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'kegiatan_id');
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
