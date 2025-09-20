<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop columns that are no longer needed
            $table->dropColumn([
                'nipd',
                'nisn',
                'nik',
                'agama',
                'alamat',
                'rt',
                'rw',
                'kecamatan',
                'ayah_nama',
                'ayah_tahun_lahir',
                'ayah_pendidikan',
                'ayah_pekerjaan',
                'ayah_penghasilan',
                'ayah_nik',
                'ibu_nama',
                'ibu_tahun_lahir',
                'ibu_pendidikan',
                'ibu_pekerjaan',
                'ibu_penghasilan',
                'ibu_nik',
                'wali_nama',
                'wali_tahun_lahir',
                'wali_pendidikan',
                'wali_pekerjaan',
                'wali_penghasilan',
                'wali_nik',
                'kelas_saat_ini'
            ]);

            // Rename columns to match your new requirements
            $table->renameColumn('nama', 'nama_murid');

            // Add new columns if they don't exist
            if (!Schema::hasColumn('students', 'no_induk')) {
                $table->string('no_induk')->nullable()->after('nama_murid');
            }
            if (!Schema::hasColumn('students', 'no_nisn')) {
                $table->string('no_nisn')->nullable()->after('no_induk');
            }
            if (!Schema::hasColumn('students', 'kelas')) {
                $table->string('kelas')->nullable()->after('tanggal_lahir');
            }
            if (!Schema::hasColumn('students', 'nama_ibu')) {
                $table->string('nama_ibu')->nullable()->after('tanggal_lahir');
            }
            if (!Schema::hasColumn('students', 'kontak_ibu')) {
                $table->string('kontak_ibu')->nullable()->after('nama_ibu');
            }
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Reverse the changes (add back all dropped columns)
            $table->renameColumn('nama_murid', 'nama');

            // Add back all the dropped columns
            $table->string('nipd')->nullable();
            $table->string('nisn')->nullable();
            $table->string('nik')->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('ayah_nama')->nullable();
            $table->year('ayah_tahun_lahir')->nullable();
            $table->string('ayah_pendidikan')->nullable();
            $table->string('ayah_pekerjaan')->nullable();
            $table->integer('ayah_penghasilan')->nullable();
            $table->string('ayah_nik')->nullable();
            $table->string('ibu_nama')->nullable();
            $table->year('ibu_tahun_lahir')->nullable();
            $table->string('ibu_pendidikan')->nullable();
            $table->string('ibu_pekerjaan')->nullable();
            $table->integer('ibu_penghasilan')->nullable();
            $table->string('ibu_nik')->nullable();
            $table->string('wali_nama')->nullable();
            $table->year('wali_tahun_lahir')->nullable();
            $table->string('wali_pendidikan')->nullable();
            $table->string('wali_pekerjaan')->nullable();
            $table->integer('wali_penghasilan')->nullable();
            $table->string('wali_nik')->nullable();
            $table->string('kelas_saat_ini')->nullable();

            // Drop the new columns
            $table->dropColumn(['no_induk', 'no_nisn', 'kelas']);
        });
    }
};