<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $user_id
 * @property string $nama_guru
 * @property string $alamat_guru
 * @property string $jabatan_guru
 * @property string $notelp_guru
 * @property string $foto_guru
 * @property User $user
 * @property Ujian[] $ujians
 */
class Guru extends Model
{
    use HasUlid;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'nama_guru', 'alamat_guru', 'jabatan_guru', 'notelp_guru', 'foto_guru'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ujians()
    {
        return $this->hasMany('App\Models\Ujian');
    }
}
