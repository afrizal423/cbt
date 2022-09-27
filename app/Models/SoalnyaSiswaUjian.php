<?php

namespace App\Models;

use Rorecek\Ulid\HasUlid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SoalnyaSiswaUjian extends Model
{
    use HasFactory;
    use HasUlid;


    /**
     * @var array
     */
    protected $fillable = ['siswa_id', 'ujian_id', 'listsoal'];

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
}
