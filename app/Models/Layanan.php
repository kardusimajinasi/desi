<?php

namespace App\Models;

use App\Models\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'tbl_layanan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'kode_layanan',
        'aktif',
    ];


    // protected $with = ['Kegiatan'];

    public function kegiatan(): HasMany
    {
        return $this->hasMany(Kegiatan::class, 'layanan_id');
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
