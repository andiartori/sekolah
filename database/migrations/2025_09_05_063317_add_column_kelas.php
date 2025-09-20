<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Rename table first
        Schema::rename('teachers', 'data_karyawan');

        Schema::table('data_karyawan', function (Blueprint $table) {
            $table->string('pangkat_gol_ruang')->after('nomor_identitas');
            $table->string('jabatan')->after('pangkat_gol_ruang');
            $table->string('tugas_utama')->after('jabatan')->nullable();
            $table->string('tugas_tambahan')->after('tugas_utama')->nullable();
            $table->dropColumn('catatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
};
