<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->enum('agama', ['islam', 'katolik', 'protestan', 'budha', 'hindu'])
                ->nullable()
                ->after('existing_column_name'); // Replace with actual column name

            $table->string('alamat')->nullable()->after('agama');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['agama', 'alamat']);
        });
    }
};