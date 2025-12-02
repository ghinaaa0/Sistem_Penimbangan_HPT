<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class penimbangan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'penimbangan';

    protected $primaryKey = 'id_timbang';

    protected $fillable = [
        'tanggal_timbang',
        'berat_timbang',
        'jenis',
        'keterangan_tempat',
        'total_upah'
    ];

}