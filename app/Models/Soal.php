<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $ujian_id
 * @property string $soal
 * @property mixed $opsi_jawaban
 * @property string $kunci
 * @property string $media_soal
 * @property string $type_soal
 * @property JawabanUjian[] $jawabanUjians
 * @property Ujian $ujian
 */
class Soal extends Model
{
    use HasUlid;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['ujian_id', 'soal', 'opsi_jawaban', 'kunci', 'media_soal', 'type_soal'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jawabanUjians()
    {
        return $this->hasMany('App\Models\JawabanUjian');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ujian()
    {
        return $this->belongsTo('App\Models\Ujian');
    }
}
