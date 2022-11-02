<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * @property string $id
 * @property string $nisn
 * @property string $nama_siswa
 * @property string $tgl_lahir_siswa
 * @property string $alamat_siswa
 * @property string $kelas_id
 * @property IkutUjian[] $ikutUjians
 * @property JawabanUjian[] $jawabanUjians
 * @property Nilai[] $nilais
 */
class Siswa extends Authenticatable
{
    use HasUlid;

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nisn',
                        'nama_siswa',
                        'tgl_lahir_siswa',
                        'alamat_siswa',
                        'password',
                        'kelas_id'];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('nisn', 'like', '%'.$query.'%')
                ->orWhere('nama_siswa', 'like', '%'.$query.'%')
                ->orWhere('alamat_siswa', 'like', '%'.$query.'%');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ikutUjians()
    {
        return $this->hasMany('App\Models\IkutUjian');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jawabanUjians()
    {
        return $this->hasMany('App\Models\JawabanUjian');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilais()
    {
        return $this->hasMany('App\Models\Nilai');
    }
}
