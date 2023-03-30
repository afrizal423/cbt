<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $id
 * @property string $soal_id
 * @property string $siswa_id
 * @property string $ujian_id
 * @property mixed $jawaban_siswa
 * @property float $bobot_nilai
 * @property Ujian $ujian
 * @property Siswa $siswa
 * @property Soal $soal
 */
class JawabanUjian extends Model
{
    use HasUlid, SoftDeletes;

    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['soal_id',
                    'siswa_id',
                    'ujian_id',
                    'jawaban_siswa',
                    'bobot_nilai',
                    'ragu_jawaban', // boolean, siswa memberi mark jika ragu pada jawaban
                    'selesai_ujian', // validasi siswa bahwa siswa ingin menyelesaikan ujian kondisi apapun
                    'rekomendasi_bobot_nilai',
                    'data_rekomendasi_nilai'
                ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ujian()
    {
        return $this->belongsTo('App\Models\Ujian');
    }

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
    public function soal()
    {
        return $this->belongsTo('App\Models\Soal');
    }
}
