<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $mapel_id
 * @property string $soal
 * @property mixed $opsi_jawaban
 * @property string $kunci
 * @property string $media_soal
 * @property string $type_soal
 * @property JawabanUjian[] $jawabanUjians
 * @property Mapel $mapel
 */
class Soal extends Model
{
    use HasUlid;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['mapel_id', 'no_soal', 'soal', 'opsi_jawaban', 'kunci', 'media_soal', 'type_soal'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jawabanUjians()
    {
        return $this->hasMany('App\Models\JawabanUjian');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listJawaban()
    {
        return $this->hasMany('App\Models\ListJawabansoal');
    }

    /**
     * Search query in multiple whereOr
     */
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('soal', 'like', '%'.$query.'%')
                ->orWhere('type_soal', 'like', '%'.$query.'%')
                ->orWhereHas('listJawaban', function($q) use ( $query ){
                    $q->where('soal_id', 'like', '%'.$query.'%')
                    ->orWhere('text_jawaban', 'like', '%'.$query.'%');
                });
    }
}
