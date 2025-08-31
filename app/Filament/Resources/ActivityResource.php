<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Activitylog\Models\Activity;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Activity Log';
    protected static ?string $pluralModelLabel = 'Activity Logs';
    protected static ?string $slug = 'activity-logs';
    protected static ?int $navigationSort = 99;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // User who did the action
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->default('System'),

                // Model affected (Student, Teacher, Download, etc.)
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn($state) => class_basename($state))
                    ->sortable(),

                // ID of the model affected
                Tables\Columns\TextColumn::make('subject_id')
                    ->label('Record ID')
                    ->sortable(),

                // Description of what happened
                Tables\Columns\TextColumn::make('description')
                    ->label('Action')
                    ->sortable(),

                // Changes made (props)
                Tables\Columns\TextColumn::make('properties')
                    ->label('Changes')
                    ->formatStateUsing(fn($state) => json_encode($state, JSON_PRETTY_PRINT))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->copyable(),

                // When it happened
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([]) // no edit/delete for logs
            ->bulkActions([]); // no bulk delete
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ActivityResource\Pages\ListActivities::route('/'),
        ];
    }
}
