<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('data_karyawan', function (Blueprint $table) {
            $table->string('nomor_identitas')->change();
        });
    }

    public function down()
    {
        Schema::table('data_karyawan', function (Blueprint $table) {
            $table->integer('nomor_identitas')->change();
        });
    }
};