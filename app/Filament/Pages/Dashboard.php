<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StudentReligionChart;
use App\Filament\Widgets\StudentYearChart;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StudentStatusStats;
use App\Filament\Widgets\StudentGenderChart;
use App\Filament\Widgets\RecentStudents;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            StudentStatusStats::class,
            StudentGenderChart::class,
                // StudentReligionChart::class,
            StudentYearChart::class,
        ];
    }

    public function getColumns(): int|string|array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }
}