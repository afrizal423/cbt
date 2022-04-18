<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $guru_id
 * @property string $kelas_id
 * @property string $judul
 * @property string $nama_mapel
 * @property string $jenis_ujian
 * @property string $tgl_mulai_ujian
 * @property string $waktu_mulai_ujian
 * @property string $tgl_selesai_ujian
 * @property string $waktu_selesai_ujian
 * @property string $code_ujian
 * @property IkutUjian[] $ikutUjians
 * @property Guru $guru
 * @property Kela $kela
 * @property JawabanUjian[] $jawabanUjians
 * @property Soal[] $soals
 * @property Nilai[] $nilais
 */
class Ujian extends Model
{
    use HasUlid;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['guru_id', 'kelas_id', 'judul', 'nama_mapel', 'jenis_ujian', 'tgl_mulai_ujian', 'waktu_mulai_ujian', 'tgl_selesai_ujian', 'waktu_selesai_ujian', 'code_ujian'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ikutUjians()
    {
        return $this->hasMany('App\Models\IkutUjian');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru()
    {
        return $this->belongsTo('App\Models\Guru');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kela', 'kelas_id');
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
    public function soals()
    {
        return $this->hasMany('App\Models\Soal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilais()
    {
        return $this->hasMany('App\Models\Nilai');
    }
}
