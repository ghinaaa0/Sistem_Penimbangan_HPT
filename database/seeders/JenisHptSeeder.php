<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisHpt;

class JenisHptSeeder extends Seeder
{
    public function run()
    {
        $jenis = [
            ['nama_jenis' => 'Rumput Gajah'],
            ['nama_jenis' => 'Rumput Kucing'],
        ];

        foreach ($jenis as $j) {
            JenisHpt::create($j);
        }
    }
}