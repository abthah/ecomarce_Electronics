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
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alat_id')->constrained()->cascadeOnDelete();
            $table->integer('jumlah');
            $table->integer('durasi'); // durasi peminjaman dalam hari
            $table->decimal('total_harga', 10, 2); // total harga peminjaman
            $table->string('nama');
            $table->string('nomor_hp');
            $table->string('alamat');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};
