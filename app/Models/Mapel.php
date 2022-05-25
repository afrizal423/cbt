<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $kode_mapel
 * @property string $nama_mapel
 * @property float $kkm_mapel
 * @property Ujian[] $ujians
 * @property Soal[] $soals
 */
class Mapel extends Model
{
    use HasUlid;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['kode_mapel', 'nama_mapel', 'kkm_mapel'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ujians()
    {
        return $this->hasMany('App\Models\Ujian');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function soals()
    {
        return $this->hasMany('App\Models\Soal');
    }
}
