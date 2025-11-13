<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\ChartWidget;

class StudentReligionChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Agama Siswa';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $islamCount = Student::where('agama', 'islam')->count();
        $budhaCount = Student::where('agama', 'budha')->count();
        $hinduCount = Student::where('agama', 'Hindu')->count();
        $kristenCount = Student::where('agama', 'kristen')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Murid',
                    'data' => [$islamCount, $budhaCount, $hinduCount, $kristenCount],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',   // Green for Islam
                        'rgb(251, 191, 36)',  // Yellow for Budha
                        'rgb(249, 115, 22)',  // Orange for Hindu
                        'rgb(59, 130, 246)',  // Blue for Kristen
                    ],
                    'borderColor' => [
                        'rgb(34, 197, 94)',
                        'rgb(251, 191, 36)',
                        'rgb(249, 115, 22)',
                        'rgb(59, 130, 246)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Islam', 'Budha', 'Hindu', 'Kristen'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Murid',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Agama',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}