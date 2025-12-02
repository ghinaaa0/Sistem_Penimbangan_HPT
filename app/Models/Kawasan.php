<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    use NasFactory, Notifiable;

    protected $table = 'petani';

    protected $primaryKey = 'id_petani';

    protected $fillable = [
        'nama_kawasan',
        'luas_kawasan'
    ];
}
