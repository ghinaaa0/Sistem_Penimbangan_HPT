<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penggajian;
use App\Models\Petani;
use Carbon\Carbon;

class PenggajianSeeder extends Seeder
{
    public function run()
    {
        $petanis = Petani::all();

        if ($petanis->isEmpty()) {
            return;
        }

        foreach ($petanis as $petani) {
            Penggajian::create([
                'id_petani' => $petani->id_petani,
                'tanggal_gaji' => Carbon::now()->subDays(rand(1, 120))->toDateString(),
                'status' => (rand(0,1) ? 'DIBAYAR' : 'BELUM'),
                'total_amount' => rand(200000, 2000000),
            ]);
        }
    }
}