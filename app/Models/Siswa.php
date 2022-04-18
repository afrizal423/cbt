<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $nisn
 * @property string $nama_siswa
 * @property string $tgl_lahir_siswa
 * @property string $alamat_siswa
 * @property IkutUjian[] $ikutUjians
 * @property JawabanUjian[] $jawabanUjians
 * @property Nilai[] $nilais
 */
class Siswa extends Model
{
    use HasUlid;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['nisn', 'nama_siswa', 'tgl_lahir_siswa', 'alamat_siswa'];

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
