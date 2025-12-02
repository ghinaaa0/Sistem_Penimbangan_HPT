<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';

    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username',
        'password',
        'nama',
        'email',
        'alamat',
        'no_hp',

    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}
