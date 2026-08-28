<?php

namespace App\Filament\Resources\ExhibitScanPages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExhibitScanPagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('path')
                    ->label('Превью')
                    ->width(80)
                    ->imageHeight(80)
                    ->getStateUsing(function ($record) {
                        if ($record->path) {
                            return asset('storage/' . $record->path);
                        }
                        return null;
                    }),
                TextColumn::make('exhibit.name')
                    ->label('Экспонат')
                    ->placeholder('Не привязан'),
                // TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('exhibit_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('status.name')
                    ->label('Статус')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'ожидает обработки' => 'gray',
                        'в обработке' => 'warning',
                        'на рассмотрении' => 'info',
                        'одобрено' => 'success',
                        'отклонено' => 'danger',
                        'ошибка' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable()
                // TextColumn::make('path')
                //     ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->poll('2s');
    }
}
