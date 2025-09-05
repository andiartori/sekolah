<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Teacher extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nama',
        'nomor_identitas',
        'catatan',
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
