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
use App\Exports\StudentsExport; // Add this line

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Data Siswa';

    protected static ?string $modelLabel = 'Siswa';

    protected static ?string $pluralModelLabel = 'Data Siswa';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Informasi Siswa')
                    ->tabs([
                        Tabs\Tab::make('Data Pribadi')
                            ->schema([
                                Section::make('Informasi Dasar Siswa')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('nama_murid')
                                                    ->label('Nama Lengkap')
                                                    ->required()
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('no_induk')
                                                    ->label('Nomor Induk')
                                                    ->required()
                                                    ->numeric()
                                                    ->unique(ignoreRecord: true),
                                                Forms\Components\TextInput::make('no_nisn')
                                                    ->label('Nomor NISN')
                                                    ->required()
                                                    ->numeric()
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
                                                Forms\Components\TextInput::make('tempat_lahir')
                                                    ->label('Tempat Lahir')
                                                    ->required(),
                                                Forms\Components\DatePicker::make('tanggal_lahir')
                                                    ->label('Tanggal Kelahiran')
                                                    ->required()
                                                    ->displayFormat('d/m/Y'),
                                            ]),

                                        // ADD THESE NEW FIELDS HERE:
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Select::make('agama')
                                                    ->label('Agama')
                                                    ->options([
                                                        'islam' => 'Islam',
                                                        'kristen' => 'Kristen',
                                                        'budha' => 'Budha',
                                                        'hindu' => 'Hindu',
                                                    ])
                                                    ->nullable()
                                                    ->searchable(),
                                                Forms\Components\Textarea::make('alamat')
                                                    ->label('Alamat')
                                                    ->rows(2)
                                                    ->nullable()
                                                    ->columnSpanFull(), // Makes it span full width
                                            ]),
                                        Forms\Components\Radio::make('status')
                                            ->label('status')
                                            ->options([
                                                'Aktif' => 'Aktif',
                                                'Alumni' => 'Alumni',
                                            ])
                                            ->required()
                                            ->default('Aktif')
                                            ->helperText('Status siswa: Aktif atau Alumni'),
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\TextInput::make('kelas')
                                                    ->label('Kelas Saat Ini')
                                                    ->helperText('Format: [Nomor Kelas][Huruf Kelas Kapital], contoh: 4A, 2B, 1A')
                                                    ->required(),
                                                Forms\Components\TextInput::make('tahun_ajar')
                                                    ->label('Tahun Ajaran')
                                                    ->required(),
                                                Forms\Components\TextInput::make('tahun_lulus')
                                                    ->label('Tahun Kelulusan')

                                            ]),
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('nama_ibu')
                                                    ->label('Nama Ibu')
                                                    ->required(),
                                                Forms\Components\TextInput::make('kontak_ibu')
                                                    ->label('Kontak Ibu')
                                                    ->tel()
                                                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('nama_murid')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_induk')
                    ->label('Nomor Induk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('no_nisn')
                    ->label('Nomor NISN')
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
                Tables\Columns\TextColumn::make('agama')
                    ->label('Agama')
                    ->badge()
                    ->color('info')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas Saat ini')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->label('Nama Ibu')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kontak_ibu')
                    ->label('Kontak Ibu')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Alumni' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('tahun_ajar')
                    ->label('Tahun Ajar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun_lulus')
                    ->label('Tahun Lulus')
                    ->searchable()
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return $record->tahun_lulus ?? 'Belum Lulus';
                    })
                    ->badge()
                    ->color(function ($record) {
                        return $record->tahun_lulus ? 'success' : 'gray';
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])

            ->filters([
                Tables\Filters\SelectFilter::make('kelas')
                    ->label('Kelas')
                    ->options(function () {
                        return Student::distinct('kelas')
                            ->pluck('kelas', 'kelas')
                            ->toArray();
                    }),
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                Tables\Filters\SelectFilter::make('agama')
                    ->label('Agama')
                    ->options([
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                        'budha' => 'Budha',
                        'hindu' => 'Hindu',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    // Simple Excel export for selected records
                    Tables\Actions\BulkAction::make('export_selected')
                        ->label('Export Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {
                            return \Maatwebsite\Excel\Facades\Excel::download(
                                new StudentsExport($records),
                                'selected-students-' . date('Y-m-d') . '.xlsx'
                            );
                        }),
                ]),
            ])
            ->headerActions([
                // Export all data action
                Tables\Actions\Action::make('export_all')
                    ->label('Export Semua Data')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function () {
                        $students = Student::all();
                        return \Maatwebsite\Excel\Facades\Excel::download(
                            new StudentsExport($students),
                            'data-siswa-' . date('Y-m-d') . '.xlsx'
                        );
                    }),
            ])
            ->defaultSort('nama_murid', 'asc');
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
            'alumni' => Pages\ListAlumniStudents::route('/alumni'),  // Move this BEFORE view and edit
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}