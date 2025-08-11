<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npid',
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
        'kelas_saat_ini',
        'ayah_id',
        'ibu_id',
        'wali_id',
    ];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relationships
    public function ayah(): BelongsTo
    {
        return $this->belongsTo(ParentModel::class, 'ayah_id');
    }

    public function ibu(): BelongsTo
    {
        return $this->belongsTo(ParentModel::class, 'ibu_id');
    }

    public function wali(): BelongsTo
    {
        return $this->belongsTo(ParentModel::class, 'wali_id');
    }


    //Helper Methods
    //dapatkan umur murid
    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->diffInYears(now());
    }
    //dapat jenis kelamin murid

    public function getJenisKelaminAttribute(): string
    {
        return $this->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    //dapat alamat lengkap murid
    public function getAlamatLengkapAttribute(): string
    {
        return "{$this->alamat}, RT {$this->rt}/RW {$this->rw}, {$this->kecamatan}";
    }

}
