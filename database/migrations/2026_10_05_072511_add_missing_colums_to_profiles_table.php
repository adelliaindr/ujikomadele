<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom yang dipakai form profil tapi belum ada di tabel.
     * Kolom yang sudah ada dilewati, jadi aman dijalankan di database mana pun.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'nama_sekolah')) {
                $table->string('nama_sekolah')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'sambutan')) {
                $table->text('sambutan')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'visi')) {
                $table->text('visi')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'misi')) {
                $table->text('misi')->nullable();
            }
            if (!Schema::hasColumn('profiles', 'sejarah')) {
                $table->text('sejarah')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('profiles', 'sambutan')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->dropColumn('sambutan');
            });
        }
    }
};