<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $kode_kelas
 * @property string $nama_kelas
 * @property Ujian[] $ujians
 */
class Kela extends Model
{
    use HasUlid;

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['kode_kelas', 'nama_kelas'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('kode_kelas', 'like', '%'.$query.'%')
                ->orWhere('nama_kelas', 'like', '%'.$query.'%');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ujians()
    {
        return $this->hasMany('App\Models\Ujian', 'kelas_id');
    }
}
