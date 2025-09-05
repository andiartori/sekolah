<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataKaryawanResource\Pages;
use App\Models\DataKaryawan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DataKaryawanResource extends Resource
{
    protected static ?string $model = DataKaryawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Data Karyawan';

    protected static ?string $modelLabel = 'Data Karyawan';

    protected static ?string $slug = 'data-karyawan';

    protected static ?string $pluralModelLabel = 'Data Karyawan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama karyawan'),

                Forms\Components\TextInput::make('nomor_identitas')
                    ->label('Nomor Identitas')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Masukkan nomor identitas')
                    ->helperText('Nomor identitas harus unik'),

                Forms\Components\TextInput::make('pangkat_gol_ruang')
                    ->label('Pangkat / Gol. Ruang')
                    ->maxLength(255),

                Forms\Components\TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->maxLength(255),

                Forms\Components\TextInput::make('tugas_mengajar')
                    ->label('Tugas Mengajar')
                    ->maxLength(255),

                Forms\Components\TextInput::make('tugas_tambahan')
                    ->label('Tugas Tambahan')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable()
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('nomor_identitas')
                    ->label('Nomor Identitas')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Nomor identitas disalin ke clipboard'),

                Tables\Columns\TextColumn::make('pangkat_gol_ruang')
                    ->label('Pangkat / Gol. Ruang')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tugas_mengajar')
                    ->label('Tugas Mengajar')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tugas_tambahan')
                    ->label('Tugas Tambahan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dibuat dari tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Dibuat sampai tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn($query, $date) => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn($query, $date) => $query->whereDate('created_at', '<=', $date),
                            );
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
            ->defaultSort('created_at', 'desc')
            ->searchable()
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            // Add relations here when you have them
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataKaryawan::route('/'),
            'create' => Pages\CreateDataKaryawan::route('/create'),
            'view' => Pages\ViewDataKaryawan::route('/{record}'),
            'edit' => Pages\EditDataKaryawan::route('/{record}/edit'),
        ];
    }
}
