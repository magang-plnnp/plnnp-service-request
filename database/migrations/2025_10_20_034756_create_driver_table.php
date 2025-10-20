<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->string('nama_driver');
            $table->string('nomer_telepon', 20);
            $table->timestamps();
        });
    }

    /**
     * Balikkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver');
    }
};
