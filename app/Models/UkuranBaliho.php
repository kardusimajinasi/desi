<?php

namespace App\Models;

use App\Models\TitikBaliho;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UkuranBaliho extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['ukuran_panjang', 'ukuran_lebar', 'layout'];

    // protected $with = ['titikBaliho'];

    public function titikBaliho(): HasMany
    {
        return $this->hasMany(TitikBaliho::class, 'ukuran_baliho_id');
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
