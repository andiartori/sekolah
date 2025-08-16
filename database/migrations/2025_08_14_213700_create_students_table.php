<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Student Basic Info
            $table->string('nama');
            $table->string('nipd');
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

            // Data Ayah
            $table->string('ayah_nama')->nullable();
            $table->integer('ayah_tahun_lahir')->nullable();
            $table->enum('ayah_pendidikan', ['TK', 'SD', 'SMP', 'SMA', 'D1', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->string('ayah_pekerjaan')->nullable();
            $table->bigInteger('ayah_penghasilan')->nullable();
            $table->string('ayah_nik')->nullable();

            // Data Ibu
            $table->string('ibu_nama')->nullable();
            $table->integer('ibu_tahun_lahir')->nullable();
            $table->enum('ibu_pendidikan', ['TK', 'SD', 'SMP', 'SMA', 'D1', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->string('ibu_pekerjaan')->nullable();
            $table->bigInteger('ibu_penghasilan')->nullable();
            $table->string('ibu_nik')->nullable();

            // Data Wali
            $table->string('wali_nama')->nullable();
            $table->integer('wali_tahun_lahir')->nullable();
            $table->enum('wali_pendidikan', ['TK', 'SD', 'SMP', 'SMA', 'D1', 'D3', 'D4', 'S1', 'S2', 'S3'])->nullable();
            $table->string('wali_pekerjaan')->nullable();
            $table->bigInteger('wali_penghasilan')->nullable();
            $table->string('wali_nik')->nullable();

            // Current Class
            $table->string('kelas_saat_ini');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};