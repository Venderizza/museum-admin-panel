<?php

namespace App\Filament\Resources\Exhibits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExhibitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Название')
                    ->searchable(),
                ImageColumn::make('photos.path')
                    ->label('Превью')
                    ->width(80)
                    ->imageHeight(80)
                    ->square()
                    ->getStateUsing(function ($record) {
                        $firstPhoto = $record->photos->first();
                        if ($firstPhoto && $firstPhoto->path) {
                            return asset('storage/' . $firstPhoto->path);
                        }
                        return null;
                    })
                    ->default(null),
                TextColumn::make('arrived_at')
                    ->label('Дата получения')
                    ->placeholder('Неизвестно')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Дата добавления записи')
                    ->dateTime()
                    ->sortable(),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable(),
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
            ]);
    }
}
