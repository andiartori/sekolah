<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Student extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nama_murid',
        'no_induk',
        'no_nisn',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'agama',
        'kelas',
        'tahun_ajar',
        'tahun_lulus',
        'status',
        'nama_ibu',
        'kontak_ibu',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
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
}