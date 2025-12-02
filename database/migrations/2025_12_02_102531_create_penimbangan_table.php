<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penimbangan', function (Blueprint $table) {
            $table->id(column: 'id_timbang');
            $table->foreignId('id_petani')->constrained()->onDelete('cascade');
            $table->string(column: 'tanggal_timbang');
            $table->string(column: 'berat_timbang');
            $table->string(column: 'jenis');
            $table->string(column:'keterangan_tempat');
            $table->string(column: 'total_upah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penimbangan');
    }
};
