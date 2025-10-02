<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Update existing data first
        DB::table('students')
            ->whereIn('agama', ['katolik', 'protestan'])
            ->update(['agama' => 'kristen']);

        // No need to alter column - PostgreSQL doesn't support enum changes easily
        // Validation will be handled at application level (Filament)
    }

    public function down()
    {
        // Cannot reliably restore 'katolik' vs 'protestan'
        // All 'kristen' values will remain as 'kristen'
    }
};