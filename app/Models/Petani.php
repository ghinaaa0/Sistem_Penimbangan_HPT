<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    protected $table = 'petani';
    protected $primaryKey = 'id_petani';

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
    ];
}

