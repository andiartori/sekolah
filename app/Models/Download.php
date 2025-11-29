<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class Download extends Model
{
    use LogsActivity;

    protected $fillable = [
        'materi_download',
        'kategori',
        'download_url',
        'file_path',
    ];

    /**
     * Configure activity log options
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    /**
     * Get the download URL - returns file URL if uploaded, otherwise external link
     */
    public function getDownloadLinkAttribute(): ?string
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }

        return $this->download_url;
    }

    /**
     * Auto-convert kategori to UPPERCASE when saving
     */
    public function setKategoriAttribute($value)
    {
        $this->attributes['kategori'] = $value ? strtoupper(trim($value)) : null;
    }
}