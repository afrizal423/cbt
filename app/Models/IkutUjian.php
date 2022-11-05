<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $siswa_id
 * @property string $ujian_id
 * @property boolean $status
 * @property Siswa $siswa
 * @property Ujian $ujian
 */
class IkutUjian extends Model
{
    use HasUlid;

    protected $primaryKey = 'id';

    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['siswa_id', 'ujian_id', 'status', 'sudah_ujian'];

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

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::whereHas('siswa', function($q) use ( $query ){
                    $q->where('nisn', 'like', '%'.$query.'%')
                    ->orWhere('nama_siswa', 'like', '%'.$query.'%')
                    ->orWhere('alamat_siswa', 'like', '%'.$query.'%');
                });
    }
}
