<?php

namespace App\Filament\Resources\DataKaryawanResource\Pages;

use App\Filament\Resources\DataKaryawanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class ListVerifikasiKaryawan extends ListRecords
{
    protected static string $resource = DataKaryawanResource::class;

    protected static ?string $title = 'Verifikasi Data Karyawan';

    protected static ?string $navigationLabel = 'Verifikasi Data Karyawan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back_to_karyawan')
                ->label('Kembali ke Data Karyawan')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(fn() => static::getResource()::getUrl('index')),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->where('is_pengajar', true))
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('nomor_identitas')
                    ->label('Nomor Identitas')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('tugas_utama')
                    ->label('Tugas Utama')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(50),

                Tables\Columns\ToggleColumn::make('is_verified')
                    ->label('Verifikasi Data Kelas')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-m-check-badge')
                    ->offIcon('heroicon-m-x-circle')
                    ->afterStateUpdated(function ($record, $state) {
                        Notification::make()
                            ->title($state ? 'Data berhasil diverifikasi' : 'Verifikasi dibatalkan')
                            ->success()
                            ->send();
                    }),

                Tables\Columns\IconColumn::make('is_pengajar')
                    ->label('Pengajar')
                    ->boolean()
                    ->trueIcon('heroicon-o-academic-cap')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('is_verified')
                //     ->label('Status Verifikasi')
                //     ->options([
                //         '1' => 'Terverifikasi',
                //         '0' => 'Belum Terverifikasi',
                //     ])
                //     ->default('0') // Default to show unverified
                //     ->placeholder('Semua Status'),

                Tables\Filters\TernaryFilter::make('is_pengajar')
                    ->label('Status Pengajar')
                    ->placeholder('Semua')
                    ->trueLabel('Pengajar')
                    ->falseLabel('Bukan Pengajar'),
            ])
            ->actions([
                // Action::make('verify')
                //     ->label('Verifikasi')
                //     ->icon('heroicon-m-check-badge')
                //     ->color('success')
                //     ->requiresConfirmation()
                //     ->modalHeading('Verifikasi Data')
                //     ->modalDescription('Apakah Anda yakin ingin memverifikasi data karyawan ini?')
                //     ->modalSubmitActionLabel('Ya, Verifikasi')
                //     ->visible(fn($record): bool => !$record->is_verified)
                //     ->action(function ($record) {
                //         $record->update(['is_verified' => true]);

                //         Notification::make()
                //             ->title('Data berhasil diverifikasi')
                //             ->success()
                //             ->send();
                //     }),

                // Action::make('unverify')
                //     ->label('Batalkan Verifikasi')
                //     ->icon('heroicon-m-x-circle')
                //     ->color('danger')
                //     ->requiresConfirmation()
                //     ->modalHeading('Batalkan Verifikasi')
                //     ->modalDescription('Apakah Anda yakin ingin membatalkan verifikasi data karyawan ini?')
                //     ->modalSubmitActionLabel('Ya, Batalkan')
                //     ->visible(fn($record): bool => $record->is_verified)
                //     ->action(function ($record) {
                //         $record->update(['is_verified' => false]);

                //         Notification::make()
                //             ->title('Verifikasi dibatalkan')
                //             ->warning()
                //             ->send();
                //     }),

                // Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('verify_selected')
                    ->label('Verifikasi Terpilih')
                    ->icon('heroicon-m-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verifikasi Data Terpilih')
                    ->modalDescription('Apakah Anda yakin ingin memverifikasi semua data yang dipilih?')
                    ->modalSubmitActionLabel('Ya, Verifikasi Semua')
                    ->action(function (Collection $records) {
                        $records->each(fn($record) => $record->update(['is_verified' => true]));

                        Notification::make()
                            ->title('Data berhasil diverifikasi')
                            ->success()
                            ->body("Berhasil memverifikasi {$records->count()} data karyawan.")
                            ->send();
                    })
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('unverify_selected')
                    ->label('Batalkan Verifikasi Terpilih')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Verifikasi Data Terpilih')
                    ->modalDescription('Apakah Anda yakin ingin membatalkan verifikasi semua data yang dipilih?')
                    ->modalSubmitActionLabel('Ya, Batalkan Semua')
                    ->action(function (Collection $records) {
                        $records->each(fn($record) => $record->update(['is_verified' => false]));

                        Notification::make()
                            ->title('Verifikasi dibatalkan')
                            ->warning()
                            ->body("Berhasil membatalkan verifikasi {$records->count()} data karyawan.")
                            ->send();
                    })
                    ->deselectRecordsAfterCompletion(),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->poll('60s')
            ->emptyStateHeading('Tidak ada data karyawan')
            ->emptyStateDescription('Belum ada data karyawan yang tersedia untuk diverifikasi.')
            ->emptyStateIcon('heroicon-o-user-group');
    }

    protected function getTableFiltersFormColumns(): int
    {
        return 2;
    }
}