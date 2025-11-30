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
        Schema::create('admin', function (Blueprint $table) {
            $table->id(column: 'id_admin');
            $table->string(column: 'username');
            $table->string(column: 'password');
            $table->string(column: 'nama');
            $table->string(column:'email')->unique();
            $table->string(column: 'alamat');
            $table->string(column: 'no_hp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
