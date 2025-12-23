<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajians';

    protected $fillable = [
        'id_petani',
        'tanggal_gaji',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'tanggal_gaji' => 'date',
    ];

    // RELATION
    public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani', 'id_petani');
    }
}
