<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Download extends Model
{
    use LogsActivity;

    protected $fillable = ['materi_download', 'download_url'];

    /**
     * Configure activity log options
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()           // log all attributes
            ->logOnlyDirty()     // log only changed fields
            ->dontSubmitEmptyLogs();
    }
}
