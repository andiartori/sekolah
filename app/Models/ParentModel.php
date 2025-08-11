<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParentModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tahun_lahir',
        'jenjang_pendidikan',
        'pekerjaan',
        'penghasilan',
        'nik',
        'jenis_kelamin',
    ];

    protected $casts = [
        'penghasilan' => 'integer',
        'tahun_lahir' => 'integer',
    ];

    //Relationship Database
    public function studentAyah(): HasMany
    {
        return $this->hasMany(Student::class, 'ayah_id');
    }

    public function studentIbu(): HasMany
    {
        return $this->hasMany(Student::class, 'ibu_id');
    }

    public function studentWali(): HasMany
    {
        return $this->hasMany(Student::class, 'wali_id');
    }

    //some Helper untuk pengolahan data
    public function getFormattedPenghasilanAttribute($value): string
    {
        return $this->penghasilan ? 'Rp' . number_format($this->penghasilan, 0, ',', '.') : 'Rp 0';
    }

    public function getUmurAttribute(): int
    {
        return now()->year - $this->tahun_lahir;
    }

    public function getFullInfoAttribute(): string
    {
        return "{$this->nama} ({$this->jenis_kelamin}) - {$this->jenjang_pendidikan}}";
    }

    public function scopeAyah($query)
    {
        return $query->where('jenis_kelamin', 'L');
    }

    public function scopeIbu($query)
    {
        return $query->where('jenis_kelamin', 'P');
    }

    public function scopeWali($query)
    {
        return $query;
    }
}


