<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Drop the check constraint on agama column
        DB::statement("ALTER TABLE students DROP CONSTRAINT IF EXISTS students_agama_check");
    }

    public function down()
    {
        // No need to recreate the constraint
    }
};