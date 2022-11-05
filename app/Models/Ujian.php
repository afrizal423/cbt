<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $mapel_id
 * @property string $guru_id
 * @property string $kelas_id
 * @property string $judul
 * @property string $jenis_ujian
 * @property string $tgl_mulai_ujian
 * @property string $waktu_mulai_ujian
 * @property string $tgl_selesai_ujian
 * @property string $waktu_selesai_ujian
 * @property string $code_ujian
 * @property boolean $status_ujian
 * @property IkutUjian[] $ikutUjians
 * @property Guru $guru
 * @property Kela $kela
 * @property Mapel $mapel
 * @property JawabanUjian[] $jawabanUjians
 * @property Nilai[] $nilais
 */
class Ujian extends Model
{
    use HasUlid;

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['mapel_id',
                        'guru_id',
                        'kelas_id',
                        'judul',
                        'jenis_ujian',
                        'tgl_mulai_ujian',
                        'waktu_mulai_ujian',
                        'tgl_selesai_ujian',
                        'waktu_selesai_ujian',
                        'code_ujian',
                        'status_ujian',
                        'keterlambatan_ujian',
                        'status_penilaian_ujian',
                        'status_jobs_selesai_ujian'];

    /**
     * Yang ditampilkan di tabel
     * nama mapel, judul, jenisujian, nama kelas, statusujian
     */

     /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('judul', 'like', '%'.$query.'%')
                ->orWhere('jenis_ujian', 'like', '%'.$query.'%')
                ->orWhere('tgl_mulai_ujian', 'like', '%'.$query.'%')
                ->orWhere('waktu_mulai_ujian', 'like', '%'.$query.'%')
                ->orWhere('tgl_selesai_ujian', 'like', '%'.$query.'%')
                ->orWhere('waktu_selesai_ujian', 'like', '%'.$query.'%')
                ->orWhereHas('guru', function($q) use ( $query ){
                    $q->where('nama_guru', 'like', '%'.$query.'%');
                })
                ->orWhereHas('kelasnya', function($q) use ( $query ){
                    $q->where('nama_kelas', 'like', '%'.$query.'%')
                    ->orWhere('kode_kelas', 'like', '%'.$query.'%');
                })
                ->orWhereHas('mapel', function($q) use ( $query ){
                    $q->where('kode_mapel', 'like', '%'.$query.'%')
                    ->orWhere('nama_mapel', 'like', '%'.$query.'%');
                });
    }
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
        return $this->belongsTo('App\Models\Guru', 'guru_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelasnya()
    {
        return $this->belongsTo('App\Models\Kela', 'kelas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SoalSiswas()
    {
        return $this->hasMany('App\Models\SoalnyaSiswaUjian');
    }
}
