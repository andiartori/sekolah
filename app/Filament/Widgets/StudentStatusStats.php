<?php
namespace App\Filament\Widgets;
use App\Models\Student;
use App\Models\DataKaryawan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentStatusStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'Aktif')->count();
        $alumniStudents = Student::where('status', 'Alumni')->count();
        $totalEmployees = DataKaryawan::count();
        $teachers = DataKaryawan::where('is_pengajar', true)->count();
        $totalClasses = Student::distinct('kelas')->count('kelas');

        // Count by religion
        $islamCount = Student::where('agama', 'islam')->count();
        $hinduCount = Student::where('agama', 'Hindu')->count();
        $budhaCount = Student::where('agama', 'budha')->count();
        $kristenCount = Student::where('agama', 'kristen')->count();

        return [
            Stat::make('Total Siswa', $totalStudents)
                ->description('Jumlah seluruh siswa')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Siswa Aktif', $activeStudents)
                ->description('Siswa yang masih aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success')
                ->chart([15, 4, 10, 2, 12, 4, 12]),

            Stat::make('Alumni', $alumniStudents)
                ->description('Siswa yang sudah lulus')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('warning')
                ->chart([10, 2, 8, 4, 6, 3, 7]),

            Stat::make('Total Karyawan', $totalEmployees)
                ->description('Jumlah seluruh karyawan')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info')
                ->chart([3, 1, 4, 1, 5, 2, 6]),

            Stat::make('Pengajar', $teachers)
                ->description('Karyawan yang mengajar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([2, 1, 3, 1, 4, 1, 4]),

            Stat::make('Total Kelas', $totalClasses)
                ->description('Jumlah kelas yang ada')
                ->descriptionIcon('heroicon-m-building-library')
                ->color('primary')
                ->chart([5, 6, 6, 7, 8, 8, 9]),

            Stat::make('Distribusi Agama', $islamCount + $hinduCount + $budhaCount + $kristenCount)
                ->description(new \Illuminate\Support\HtmlString(
                    '<div style="display: flex; flex-wrap: wrap; gap: 0.5rem 1rem; margin-top: 0.25rem;">' .
                    '<div style="min-width: 45%;"><strong>Islam:</strong> ' . $islamCount . '</div>' .
                    '<div style="min-width: 45%;"><strong>Kristen:</strong> ' . $kristenCount . '</div>' .
                    '<div style="min-width: 45%;"><strong>Hindu:</strong> ' . $hinduCount . '</div>' .
                    '<div style="min-width: 45%;"><strong>Budha:</strong> ' . $budhaCount . '</div>' .
                    '</div>'
                ))
                ->descriptionIcon('heroicon-m-globe-asia-australia')
                ->color('warning'),
        ];
    }
}