<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // First, update existing data
        DB::table('students')
            ->whereIn('agama', ['katolik', 'protestan'])
            ->update(['agama' => 'kristen']);

        // Then, modify the enum column
        Schema::table('students', function (Blueprint $table) {
            $table->enum('agama', ['islam', 'kristen', 'budha', 'hindu'])
                ->nullable()
                ->change();
        });
    }

    public function down()
    {
        // Revert the enum to original values
        Schema::table('students', function (Blueprint $table) {
            $table->enum('agama', ['islam', 'katolik', 'protestan', 'budha', 'hindu'])
                ->nullable()
                ->change();
        });

        // Note: We cannot reliably restore 'katolik' vs 'protestan' 
        // All 'kristen' values will remain as 'kristen'
    }
};