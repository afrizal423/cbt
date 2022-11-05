<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $soal_id
 * @property string $type_jawaban
 * @property mixed $text_jawaban
 * @property string $keyPilgan
 * @property Soal $soal
 */
class ListJawabansoal extends Model
{
    use HasUlid;

    protected $primaryKey = 'id';

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['soal_id', 'type_jawaban', 'text_jawaban', 'keyPilgan'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function soalnya()
    {
        return $this->belongsTo('App\Models\Soal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soal()
    {
        return $this->belongsTo('App\Models\Soal');
    }
}
