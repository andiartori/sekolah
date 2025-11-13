<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentGenderChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Jenis Kelamin Siswa';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $maleCount = Student::where('jenis_kelamin', 'L')->count();
        $femaleCount = Student::where('jenis_kelamin', 'P')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Distribusi Gender',
                    'data' => [$maleCount, $femaleCount],
                    'backgroundColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(236, 72, 153)',
                    ],
                    'borderWidth' => 2,
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(236, 72, 153)',
                    ],
                ],
            ],
            'labels' => [
                "Laki-laki ({$maleCount})",
                "Perempuan ({$femaleCount})"
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}