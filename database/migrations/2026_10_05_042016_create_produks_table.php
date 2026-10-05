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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori'); // Contoh: PPLG, TJKT, TO, TPFL
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('link_demo')->nullable(); // Link demo / GitHub / Drive
            $table->string('pembuat')->nullable(); // Nama siswa / Tim
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
