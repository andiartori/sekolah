<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Data Siswa';

    protected static ?string $modelLabel = 'Siswa';

    protected static ?string $pluralModelLabel = 'Data Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Student Information')
                    ->tabs([
                        Tabs\Tab::make('Data Pribadi')
                            ->schema([
                                Section::make('Informasi Dasar Siswa')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('nama')
                                                    ->label('Nama Lengkap')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('nipd')
                                                    ->label('NIPD')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                            ]),

                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\Select::make('jenis_kelamin')
                                                    ->label('Jenis Kelamin')
                                                    ->options([
                                                        'L' => 'Laki-laki',
                                                        'P' => 'Perempuan',
                                                    ])
                                                    ->required(),
                                                Forms\Components\TextInput::make('nisn')
                                                    ->label('NISN')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                                Forms\Components\TextInput::make('nik')
                                                    ->label('NIK')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('tempat_lahir')
                                                    ->label('Tempat Lahir')
                                                    ->required(),
                                                Forms\Components\DatePicker::make('tanggal_lahir')
                                                    ->label('Tanggal Lahir')
                                                    ->required()
                                                    ->displayFormat('d/m/Y'),
                                            ]),

                                        Forms\Components\TextInput::make('agama')
                                            ->label('Agama')
                                            ->required(),

                                        Forms\Components\Textarea::make('alamat')
                                            ->label('Alamat')
                                            ->required()
                                            ->rows(3),

                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('rt')
                                                    ->label('RT')
                                                    ->required(),
                                                Forms\Components\TextInput::make('rw')
                                                    ->label('RW')
                                                    ->required(),
                                                Forms\Components\TextInput::make('kecamatan')
                                                    ->label('Kecamatan')
                                                    ->required(),
                                            ]),

                                        Forms\Components\TextInput::make('kelas_saat_ini')
                                            ->label('Kelas Saat Ini')
                                            ->required(),
                                    ])
                            ]),

                        Tabs\Tab::make('Data Ayah')
                            ->schema([
                                Section::make('Informasi Ayah')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('ayah_nama')
                                                    ->label('Nama Ayah'),
                                                Forms\Components\TextInput::make('ayah_tahun_lahir')
                                                    ->label('Tahun Lahir')
                                                    ->numeric()
                                                    ->minValue(1900)
                                                    ->maxValue(date('Y')),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Select::make('ayah_pendidikan')
                                                    ->label('Jenjang Pendidikan')
                                                    ->options([
                                                        'TK' => 'TK',
                                                        'SD' => 'SD',
                                                        'SMP' => 'SMP',
                                                        'SMA' => 'SMA',
                                                        'D1' => 'D1',
                                                        'D3' => 'D3',
                                                        'D4' => 'D4',
                                                        'S1' => 'S1',
                                                        'S2' => 'S2',
                                                        'S3' => 'S3',
                                                    ]),
                                                Forms\Components\TextInput::make('ayah_pekerjaan')
                                                    ->label('Pekerjaan'),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('ayah_penghasilan')
                                                    ->label('Penghasilan')
                                                    ->numeric()
                                                    ->prefix('Rp'),
                                                Forms\Components\TextInput::make('ayah_nik')
                                                    ->label('NIK Ayah'),
                                            ]),
                                    ])
                            ]),

                        Tabs\Tab::make('Data Ibu')
                            ->schema([
                                Section::make('Informasi Ibu')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('ibu_nama')
                                                    ->label('Nama Ibu'),
                                                Forms\Components\TextInput::make('ibu_tahun_lahir')
                                                    ->label('Tahun Lahir')
                                                    ->numeric()
                                                    ->minValue(1900)
                                                    ->maxValue(date('Y')),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Select::make('ibu_pendidikan')
                                                    ->label('Jenjang Pendidikan')
                                                    ->options([
                                                        'TK' => 'TK',
                                                        'SD' => 'SD',
                                                        'SMP' => 'SMP',
                                                        'SMA' => 'SMA',
                                                        'D1' => 'D1',
                                                        'D3' => 'D3',
                                                        'D4' => 'D4',
                                                        'S1' => 'S1',
                                                        'S2' => 'S2',
                                                        'S3' => 'S3',
                                                    ]),
                                                Forms\Components\TextInput::make('ibu_pekerjaan')
                                                    ->label('Pekerjaan'),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('ibu_penghasilan')
                                                    ->label('Penghasilan')
                                                    ->numeric()
                                                    ->prefix('Rp'),
                                                Forms\Components\TextInput::make('ibu_nik')
                                                    ->label('NIK Ibu'),
                                            ]),
                                    ])
                            ]),

                        Tabs\Tab::make('Data Wali')
                            ->schema([
                                Section::make('Informasi Wali')
                                    ->description('Isi jika siswa tinggal dengan wali')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('wali_nama')
                                                    ->label('Nama Wali'),
                                                Forms\Components\TextInput::make('wali_tahun_lahir')
                                                    ->label('Tahun Lahir')
                                                    ->numeric()
                                                    ->minValue(1900)
                                                    ->maxValue(date('Y')),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Select::make('wali_pendidikan')
                                                    ->label('Jenjang Pendidikan')
                                                    ->options([
                                                        'TK' => 'TK',
                                                        'SD' => 'SD',
                                                        'SMP' => 'SMP',
                                                        'SMA' => 'SMA',
                                                        'D1' => 'D1',
                                                        'D3' => 'D3',
                                                        'D4' => 'D4',
                                                        'S1' => 'S1',
                                                        'S2' => 'S2',
                                                        'S3' => 'S3',
                                                    ]),
                                                Forms\Components\TextInput::make('wali_pekerjaan')
                                                    ->label('Pekerjaan'),
                                            ]),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('wali_penghasilan')
                                                    ->label('Penghasilan')
                                                    ->numeric()
                                                    ->prefix('Rp'),
                                                Forms\Components\TextInput::make('wali_nik')
                                                    ->label('NIK Wali'),
                                            ]),
                                    ])
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nipd')
                    ->label('NIPD')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nisn')
                    ->label('NISN')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('L/P')
                    ->formatStateUsing(fn(string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'L' => 'info',
                        'P' => 'success',
                    }),
                Tables\Columns\TextColumn::make('kelas_saat_ini')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('agama')
                    ->label('Agama')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                Tables\Filters\SelectFilter::make('kelas_saat_ini')
                    ->label('Kelas')
                    ->options(function () {
                        return Student::distinct('kelas_saat_ini')
                            ->pluck('kelas_saat_ini', 'kelas_saat_ini')
                            ->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('nama', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}