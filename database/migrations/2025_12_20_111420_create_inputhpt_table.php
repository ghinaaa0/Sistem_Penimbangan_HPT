<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inputhpt', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petani');
            $table->string('kategori_hpt');
            $table->decimal('jumlah_hpt', 8, 2);
            $table->string('keterangan_tempat');
            $table->date('tanggal_pemasukan');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inputhpt');
    }
};
