<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $ujian_id
 * @property string $siswa_id
 * @property float $nilai_ujian
 * @property Siswa $siswa
 * @property Ujian $ujian
 */
class Nilai extends Model
{
    use HasUlid;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['ujian_id', 'siswa_id', 'nilai_ujian'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ujian()
    {
        return $this->belongsTo('App\Models\Ujian');
    }
}
