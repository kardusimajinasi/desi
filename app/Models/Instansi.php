<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Instansi extends Model
{
    protected $table = 'tbl_instansi';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'kategori',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    //agar instansi tersimpan dalam huruf kapital
    public function setInstansiAttribute($value)
    {
        $this->attributes['instansi'] = strtoupper($value);
    }

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'instansi_id');
    }
}
