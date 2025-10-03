<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;

class ViewStudent extends ViewRecord
{
    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Detail Siswa')
                    ->tabs([
                        Tabs\Tab::make('Data Pribadi')
                            ->schema([
                                Section::make('Informasi Dasar Siswa')
                                    ->schema([
                                        TextEntry::make('nama_murid')
                                            ->label('Nama')
                                            ->weight('bold')
                                            ->size('lg')
                                            ->inlineLabel(),
                                        TextEntry::make('no_induk')
                                            ->label('Nomor Induk')
                                            ->copyable()
                                            ->icon('heroicon-o-identification')
                                            ->inlineLabel(),
                                        TextEntry::make('no_nisn')
                                            ->label('Nomor NISN')
                                            ->copyable()
                                            ->icon('heroicon-o-identification')
                                            ->inlineLabel(),
                                        TextEntry::make('status')
                                            ->label('Status')
                                            ->badge()
                                            ->color(fn(string $state): string => match ($state) {
                                                'Aktif' => 'success',
                                                'Alumni' => 'warning',
                                                default => 'gray',
                                            })
                                            ->inlineLabel(),
                                        TextEntry::make('jenis_kelamin')
                                            ->label('Jenis Kelamin')
                                            ->formatStateUsing(fn(string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan')
                                            ->badge()
                                            ->color(fn(string $state): string => match ($state) {
                                                'L' => 'info',
                                                'P' => 'success',
                                            })
                                            ->inlineLabel(),
                                        TextEntry::make('tempat_lahir')
                                            ->label('Tempat Lahir')
                                            ->icon('heroicon-o-map-pin')
                                            ->inlineLabel(),
                                        TextEntry::make('tanggal_lahir')
                                            ->label('Tanggal Lahir')
                                            ->date('d F Y')
                                            ->icon('heroicon-o-calendar-days')
                                            ->inlineLabel(),
                                        TextEntry::make('alamat')
                                            ->label('Alamat')
                                            ->icon('heroicon-o-home')
                                            ->inlineLabel(),
                                        TextEntry::make('agama')
                                            ->label('Agama')
                                            ->icon('heroicon-o-sparkles')
                                            ->inlineLabel(),
                                        TextEntry::make('kelas')
                                            ->label('Kelas Saat Ini')
                                            ->badge()
                                            ->color('info')
                                            ->icon('heroicon-o-academic-cap')
                                            ->inlineLabel(),
                                        TextEntry::make('tahun_ajar')
                                            ->label('Tahun Ajaran')
                                            ->badge()
                                            ->color('primary')
                                            ->inlineLabel(),
                                        TextEntry::make('tahun_lulus')
                                            ->label('Tahun Lulus')
                                            ->formatStateUsing(function ($state) {
                                                return $state ?? 'Belum Lulus';
                                            })
                                            ->badge()
                                            ->color(function ($state) {
                                                return $state ? 'success' : 'gray';
                                            })
                                            ->icon(function ($state) {
                                                return $state ? 'heroicon-o-trophy' : 'heroicon-o-clock';
                                            })
                                            ->inlineLabel(),
                                    ])
                                    ->columns(3)
                                    ->columnSpanFull()
                                    ->compact(),

                                Section::make('Informasi Orang Tua/Wali')
                                    ->schema([
                                        TextEntry::make('nama_ibu')
                                            ->label('Nama Ibu')
                                            ->icon('heroicon-o-user')
                                            ->placeholder('Tidak ada data')
                                            ->inlineLabel(),
                                        TextEntry::make('kontak_ibu')
                                            ->label('Kontak Ibu')
                                            ->icon('heroicon-o-phone')
                                            ->copyable()
                                            ->placeholder('Tidak ada data')
                                            ->inlineLabel(),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull()
                                    ->compact(),

                                Section::make('Informasi Sistem')
                                    ->schema([
                                        TextEntry::make('created_at')
                                            ->label('Tanggal Dibuat')
                                            ->dateTime('d F Y, H:i')
                                            ->icon('heroicon-o-calendar-days')
                                            ->inlineLabel(),
                                        TextEntry::make('updated_at')
                                            ->label('Terakhir Diperbarui')
                                            ->dateTime('d F Y, H:i')
                                            ->icon('heroicon-o-pencil-square')
                                            ->inlineLabel(),
                                    ])
                                    ->columns(2)
                                    ->columnSpanFull()
                                    ->collapsed()
                                    ->compact(),
                            ]),
                    ])
                    ->columnSpanFull()
            ])
            ->columns(1); // This ensures full width
    }

    // Override the default layout to make it full width
    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'maxContentWidth' => null,
        ]);
    }
}