<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // First, update NULL values to 'false' before conversion
        DB::statement("UPDATE data_karyawan SET is_verified = 'false' WHERE is_verified IS NULL");

        // Then update existing data to boolean-compatible values
        DB::statement("UPDATE data_karyawan SET is_verified = CASE 
            WHEN is_verified = '' THEN 'false'
            WHEN is_verified = '0' THEN 'false'
            WHEN is_verified = 'false' THEN 'false'
            ELSE 'true'
        END");

        // Then change the column type using USING clause
        DB::statement('ALTER TABLE data_karyawan ALTER COLUMN is_verified TYPE boolean USING is_verified::boolean');

        // Set default value (this will make it NOT NULL with default false)
        DB::statement('ALTER TABLE data_karyawan ALTER COLUMN is_verified SET DEFAULT false');
        DB::statement('ALTER TABLE data_karyawan ALTER COLUMN is_verified SET NOT NULL');
    }

    public function down(): void
    {
        Schema::table('data_karyawan', function (Blueprint $table) {
            $table->string('is_verified')->nullable()->change();
        });
    }
};