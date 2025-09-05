<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nipd',
        'jenis_kelamin',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
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
        'kelas_saat_ini',
        'tahun_ajar',
        'status'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'ayah_penghasilan' => 'integer',
        'ibu_penghasilan' => 'integer',
        'wali_penghasilan' => 'integer',
    ];

    // 🔹 Configure Activity Log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // log semua atribut
            ->logOnlyDirty() // hanya log kalau ada perubahan
            ->dontSubmitEmptyLogs(); // jangan log kalau tidak ada perubahan
    }

    // Helper method to get age
    public function getUmurAttribute()
    {
        return \Illuminate\Support\Carbon::parse($this->tanggal_lahir)->diffInYears(now());
    }


    // Helper method to format penghasilan
    public function getFormattedAyahPenghasilanAttribute()
    {
        return $this->ayah_penghasilan ? 'Rp ' . number_format($this->ayah_penghasilan, 0, ',', '.') : '-';
    }

    public function getFormattedIbuPenghasilanAttribute()
    {
        return $this->ibu_penghasilan ? 'Rp ' . number_format($this->ibu_penghasilan, 0, ',', '.') : '-';
    }

    public function getFormattedWaliPenghasilanAttribute()
    {
        return $this->wali_penghasilan ? 'Rp ' . number_format($this->wali_penghasilan, 0, ',', '.') : '-';
    }
}