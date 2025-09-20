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
            'Nomor Induk',
            'Nama Lengkap',
            'Nomor NISN',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Kelas Saat Ini',
            'Tahun Ajaran',
            'Tahun Kelulusan',
            'Status',
            'Nama Ibu',
            'Kontak Ibu',
            'Tanggal Dibuat',
            'Terakhir Diperbarui'
        ];
    }

    /**
     * Map the data for each row
     */
    public function map($student): array
    {
        return [
            $student->no_induk,
            $student->nama_murid,
            $student->no_nisn,
            $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $student->tempat_lahir,
            $student->tanggal_lahir ? $student->tanggal_lahir->format('d/m/Y') : '',
            $student->kelas,
            $student->tahun_ajar,
            $student->tahun_lulus ?? 'Belum Lulus',
            $student->status,
            $student->nama_ibu,
            $student->kontak_ibu,
            $student->created_at ? $student->created_at->format('d/m/Y H:i:s') : '',
            $student->updated_at ? $student->updated_at->format('d/m/Y H:i:s') : '',
        ];
    }

    /**
     * Apply styles to the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold
            1 => ['font' => ['bold' => true, 'size' => 12]],
            // Auto-fit columns
            'A:N' => ['alignment' => ['horizontal' => 'left']],
        ];
    }
}