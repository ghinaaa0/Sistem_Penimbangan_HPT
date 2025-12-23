<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisHpt extends Model
{
    protected $table = 'jenis_hpt';

    protected $fillable = [
        'nama_jenis',
    ];

    public function dataHpt()
    {
        return $this->hasMany(DataHpt::class, 'jenis_hpt_id', 'id');
    }
}
