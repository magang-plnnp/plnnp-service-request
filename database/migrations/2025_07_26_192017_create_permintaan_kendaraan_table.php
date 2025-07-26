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
        Schema::create('permintaan_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nid', 50);
            $table->unsignedBigInteger('sub_bidang_id');
            $table->string('no_hp', 20);
            $table->text('lokasi_penjemputan');
            $table->dateTime('tanggal_waktu');
            $table->text('tujuan');
            $table->string('file')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('sub_bidang_id')->references('id')->on('sub_bidang')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_kendaraan');
    }
};
