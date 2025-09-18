<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $students;

    public function __construct($students = null)
    {
        $this->students = $students;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->students) {
            return $this->students;
        }

        return Student::all();
    }

    /**
     * Define the headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'NIPD',
            'Nama Lengkap',
            'NISN',
            'NIK',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Alamat',
            'RT',
            'RW',
            'Kecamatan',
            'Kelas Saat Ini',
            'Tahun Ajaran',
            'Status',
            'Nama Ayah',
            'Tahun Lahir Ayah',
            'Pendidikan Ayah',
            'Pekerjaan Ayah',
            'Penghasilan Ayah',
            'NIK Ayah',
            'Nama Ibu',
            'Tahun Lahir Ibu',
            'Pendidikan Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Ibu',
            'NIK Ibu',
            'Nama Wali',
            'Tahun Lahir Wali',
            'Pendidikan Wali',
            'Pekerjaan Wali',
            'Penghasilan Wali',
            'NIK Wali',
            'Tanggal Dibuat'
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($student): array
    {
        return [
            $student->nipd,
            $student->nama,
            $student->nisn,
            $student->nik,
            $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $student->tempat_lahir,
            $student->tanggal_lahir ? $student->tanggal_lahir->format('d/m/Y') : '',
            $student->agama,
            $student->alamat,
            $student->rt,
            $student->rw,
            $student->kecamatan,
            $student->kelas_saat_ini,
            $student->tahun_ajar,
            $student->status,
            $student->ayah_nama,
            $student->ayah_tahun_lahir,
            $student->ayah_pendidikan,
            $student->ayah_pekerjaan,
            $student->ayah_penghasilan ? 'Rp ' . number_format($student->ayah_penghasilan, 0, ',', '.') : '',
            $student->ayah_nik,
            $student->ibu_nama,
            $student->ibu_tahun_lahir,
            $student->ibu_pendidikan,
            $student->ibu_pekerjaan,
            $student->ibu_penghasilan ? 'Rp ' . number_format($student->ibu_penghasilan, 0, ',', '.') : '',
            $student->ibu_nik,
            $student->wali_nama,
            $student->wali_tahun_lahir,
            $student->wali_pendidikan,
            $student->wali_pekerjaan,
            $student->wali_penghasilan ? 'Rp ' . number_format($student->wali_penghasilan, 0, ',', '.') : '',
            $student->wali_nik,
            $student->created_at->format('d/m/Y H:i:s'),
        ];
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold
            1 => ['font' => ['bold' => true]],
        ];
    }
}