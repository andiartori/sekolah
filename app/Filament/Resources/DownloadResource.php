<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Filament\Resources\DownloadResource\RelationManagers;
use App\Models\Download;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static ?string $navigationLabel = 'Download';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi File')
                    ->schema([
                        Forms\Components\TextInput::make('materi_download')
                            ->label('Judul / Title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('kategori')
                            ->label('Kategori')
                            ->placeholder('Contoh: RAPOT, SURAT, MATERI')
                            ->maxLength(100)
                            ->helperText('Akan otomatis diubah ke HURUF BESAR'),

                        Forms\Components\FileUpload::make('file_path')
                            ->label('Upload File PDF')
                            ->directory('downloads')
                            ->preserveFilenames()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(10240)
                            ->downloadable()
                            ->openable()
                            ->helperText('Format: PDF saja. Max: 10MB')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('download_url')
                            ->label('Atau Link External (Opsional)')
                            ->url()
                            ->maxLength(255)
                            ->helperText('Isi jika ingin menggunakan link external seperti Google Drive')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('materi_download')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('warning')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn($state) => $state ? '✅ Ada File' : '-')
                    ->badge()
                    ->color(fn($state) => $state ? 'success' : 'gray'),

                Tables\Columns\TextColumn::make('download_url')
                    ->label('Link External')
                    ->formatStateUsing(fn($state) => $state ? '🔗 Ada Link' : '-')
                    ->badge()
                    ->color(fn($state) => $state ? 'info' : 'gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Filter Kategori')
                    ->options(
                        fn() => Download::whereNotNull('kategori')
                            ->distinct()
                            ->pluck('kategori', 'kategori')
                            ->toArray()
                    )
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn(Download $record): ?string => $record->download_link)
                    ->openUrlInNewTab()
                    ->visible(fn(Download $record): bool => $record->file_path || $record->download_url),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListDownloads::route('/'),
            'create' => Pages\CreateDownload::route('/create'),
            'edit' => Pages\EditDownload::route('/{record}/edit'),
        ];
    }
}
