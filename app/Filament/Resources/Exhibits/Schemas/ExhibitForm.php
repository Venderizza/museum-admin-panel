<?php

namespace App\Filament\Resources\Exhibits\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;

class ExhibitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                DateTimePicker::make('arrived_at'),

                Repeater::make('photos')
                    ->relationship('photos')
                    ->schema([
                        FileUpload::make('path')
                            ->label('Изображение')
                            ->image()
                            ->disk('public')
                            ->directory('exhibit-photos')
                            ->imagePreviewHeight('150px')
                            ->deleteUploadedFileUsing(fn($file) => true),
                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data): ?array {
                        if (empty($data['path'])) {
                            return null;
                        }
                        return $data;
                    })
                    ->columnSpanFull()
                    ->collapsible()
                    ->addActionLabel('Добавить фотографию')
                    ->maxItems(5)

            ]);
    }
}
