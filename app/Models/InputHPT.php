<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputHPT extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_petani',
        'kategori_hpt',
        'jumlah_hpt',
        'keterangan_tempat',
        'tanggal_pemasukan',
        'file'
    ];
}
