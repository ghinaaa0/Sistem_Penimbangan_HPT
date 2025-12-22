<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hpt extends Model
{
    protected $table = 'inputhpt';

    protected $fillable = [
        'id_petani',
        'id_kategori',
        'id_blok',
        'jumlah_hpt',
        'tanggal_pemasukan'
    ];

     public function petani()
    {
        return $this->belongsTo(Petani::class, 'id_petani');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriHpt::class, 'id_kategori');
    }
    public function blok()
    {
        return $this->belongsTo(BlokLahan::class, 'id_blok');
    }

}
