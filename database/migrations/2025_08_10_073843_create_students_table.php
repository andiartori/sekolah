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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            //data murid basic
            $table->string('name');
            $table->string('npid');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nisn');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nik');
            $table->string('agama');
            $table->text('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('kecamatan');
            $table->string('kelas_saat_ini');


            // //Foreign keys untuk data parents
            // $table->foreignId('ayah_id')->nullable()->constrained('parent_models')->onDelete('set null');
            // $table->foreignId('ibu_id')->nullable()->constrained('parent_models')->onDelete('set null');
            // $table->foreignId('wali_id')->nullable()->constrained('parent_models')->onDelete('set null');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
