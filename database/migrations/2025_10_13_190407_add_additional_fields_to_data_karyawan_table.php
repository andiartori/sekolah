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
        Schema::table('data_karyawan', function (Blueprint $table) {
            $table->date('tmt')->nullable()->after('tugas_tambahan')->comment('Tanggal Mulai Tugas');
            $table->date('sk')->nullable()->after('tmt')->comment('Surat Keputusan');
            $table->year('tahun_pensiun')->nullable()->after('sk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_karyawan', function (Blueprint $table) {
            $table->dropColumn(['tmt', 'sk', 'tahun_pensiun']);
        });
    }
};
