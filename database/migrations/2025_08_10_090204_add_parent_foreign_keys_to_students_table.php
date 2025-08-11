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
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('ayah_id')
                ->nullable()
                ->constrained('parent_models')
                ->onDelete('set null');
            $table->foreignId('ibu_id')
                ->nullable()
                ->constrained('parent_models')
                ->onDelete('set null');
            $table->foreignId('wali_id')
                ->nullable()
                ->constrained('parent_models')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['ayah_id']);
            $table->dropForeign(['ibu_id']);
            $table->dropForeign(['wali_id']);
            $table->dropColumn(['ayah_id', 'ibu_id', 'wali_id']);
        });
    }
};
