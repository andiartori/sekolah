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
            // Skip is_verified since it already exists
            if (!Schema::hasColumn('data_karyawan', 'is_verified')) {
                $table->string('is_verified')->nullable();
            }

            // Add any other columns you need here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
