<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use App\Models\Documentation;

class PermohonanDetMedKomElektronik extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'permohonan_id',
        'isi_konten',
        'tgl_mulai_publikasi',
        'tgl_selesai_publikasi',
        'durasi_hari',
        'volume_hitung',
        'anggaran_id',
        'kegiatan_id',
    ]; 

    protected $with = ['anggaranBelanja', 'kegiatan'];
    
    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }

    public function anggaranBelanja(): BelongsTo
    {
        return $this->belongsTo(AnggaranBelanja::class, 'anggaran_id');
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

    public function dokumentasi(): MorphMany
    {
        return $this->morphMany(Documentation::class, 'dokumentasiable');
    }

  
   protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        static::deleted(function ($model) {

            $anggaranId = $model->anggaran_id;
            if (!$anggaranId || $anggaranId == '1na-1') return;

            $anggaran = AnggaranBelanja::find($anggaranId);
            if (!$anggaran) return;
            $totalPenggunaan = PermohonanDetMedKomCetak::where('anggaran_id', $anggaranId)
                ->sum('volume_hitung');
            $anggaran->update([
                'sisa_volume' => $anggaran->volume_awal - $totalPenggunaan
            ]);

            $model->dokumentasi->each(function ($item) {
                $item->delete(); // Ini akan memicu static::deleted di model Documentation
            });
        });
    }

}
