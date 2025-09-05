<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAlumniStudents extends ListRecords
{
    protected static string $resource = StudentResource::class;

    protected static ?string $title = 'Data Alumni';

    protected static ?string $navigationLabel = 'Data Alumni';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back_to_students')
                ->label('Kembali ke Data Siswa')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(fn() => static::getResource()::getUrl('index')),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('status', 'Alumni');
    }

    protected function getTableFiltersFormColumns(): int
    {
        return 2;
    }
}