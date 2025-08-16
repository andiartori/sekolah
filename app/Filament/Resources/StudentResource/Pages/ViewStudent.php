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
                Tabs::make('Student Details')
                    ->tabs([
                        Tabs\Tab::make('Data Pribadi')
                            ->schema([
                                Section::make('Informasi Dasar')
                                    ->schema([
                                        TextEntry::make('nama')->label('Nama Lengkap'),
                                        TextEntry::make('nipd')->label('NIPD'),
                                        TextEntry::make('nisn')->label('NISN'),
                                        TextEntry::make('jenis_kelamin')
                                            ->label('Jenis Kelamin')
                                            ->formatStateUsing(fn(string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan'),
                                        TextEntry::make('nik')->label('NIK'),
                                        TextEntry::make('tempat_lahir')->label('Tempat Lahir'),
                                        TextEntry::make('tanggal_lahir')
                                            ->label('Tanggal Lahir')
                                            ->date('d F Y'),
                                        TextEntry::make('agama')->label('Agama'),
                                        TextEntry::make('alamat')->label('Alamat'),
                                        TextEntry::make('rt')->label('RT'),
                                        TextEntry::make('rw')->label('RW'),
                                        TextEntry::make('kecamatan')->label('Kecamatan'),
                                        TextEntry::make('kelas_saat_ini')->label('Kelas Saat Ini'),
                                    ])->columns(2)
                            ]),

                        Tabs\Tab::make('Data Ayah')
                            ->schema([
                                Section::make('Informasi Ayah')
                                    ->schema([
                                        TextEntry::make('ayah_nama')->label('Nama')->placeholder('Tidak ada data'),
                                        TextEntry::make('ayah_tahun_lahir')->label('Tahun Lahir')->placeholder('Tidak ada data'),
                                        TextEntry::make('ayah_pendidikan')->label('Pendidikan')->placeholder('Tidak ada data'),
                                        TextEntry::make('ayah_pekerjaan')->label('Pekerjaan')->placeholder('Tidak ada data'),
                                        TextEntry::make('ayah_penghasilan')
                                            ->label('Penghasilan')
                                            ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Tidak ada data'),
                                        TextEntry::make('ayah_nik')->label('NIK')->placeholder('Tidak ada data'),
                                    ])->columns(2)
                            ]),

                        Tabs\Tab::make('Data Ibu')
                            ->schema([
                                Section::make('Informasi Ibu')
                                    ->schema([
                                        TextEntry::make('ibu_nama')->label('Nama')->placeholder('Tidak ada data'),
                                        TextEntry::make('ibu_tahun_lahir')->label('Tahun Lahir')->placeholder('Tidak ada data'),
                                        TextEntry::make('ibu_pendidikan')->label('Pendidikan')->placeholder('Tidak ada data'),
                                        TextEntry::make('ibu_pekerjaan')->label('Pekerjaan')->placeholder('Tidak ada data'),
                                        TextEntry::make('ibu_penghasilan')
                                            ->label('Penghasilan')
                                            ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Tidak ada data'),
                                        TextEntry::make('ibu_nik')->label('NIK')->placeholder('Tidak ada data'),
                                    ])->columns(2)
                            ]),

                        Tabs\Tab::make('Data Wali')
                            ->schema([
                                Section::make('Informasi Wali')
                                    ->schema([
                                        TextEntry::make('wali_nama')->label('Nama')->placeholder('Tidak ada data'),
                                        TextEntry::make('wali_tahun_lahir')->label('Tahun Lahir')->placeholder('Tidak ada data'),
                                        TextEntry::make('wali_pendidikan')->label('Pendidikan')->placeholder('Tidak ada data'),
                                        TextEntry::make('wali_pekerjaan')->label('Pekerjaan')->placeholder('Tidak ada data'),
                                        TextEntry::make('wali_penghasilan')
                                            ->label('Penghasilan')
                                            ->formatStateUsing(fn($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : 'Tidak ada data'),
                                        TextEntry::make('wali_nik')->label('NIK')->placeholder('Tidak ada data'),
                                    ])->columns(2)
                            ]),
                    ])
            ]);
    }
}