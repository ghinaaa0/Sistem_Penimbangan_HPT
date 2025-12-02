<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'petani';

    protected $primaryKey = 'id_petani';

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp'
    ];

}
