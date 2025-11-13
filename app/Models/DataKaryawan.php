<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DataKaryawan extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'data_karyawan';

    protected $fillable = [
        'nama',
        'nomor_identitas',
        'pangkat_gol_ruang',
        'jabatan',
        'tugas_utama',
        'tugas_tambahan',
        'tmt',
        'sk',
        'tahun_pensiun',
        'is_pengajar',
        'is_verified'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tmt' => 'date',
        'sk' => 'date',
        'tahun_pensiun' => 'integer',
        'is_pengajar' => 'boolean',
        'is_verified' => 'boolean',
    ];

    /**
     * Configure activity log options
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()           // log all attributes
            ->logOnlyDirty()     // only log changed fields
            ->dontSubmitEmptyLogs();
    }
}