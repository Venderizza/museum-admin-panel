<?php

namespace App\Filament\Resources\ExhibitPhotos\Schemas;

use App\Models\Exhibit;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExhibitPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        $exhibits = Exhibit::all();

        return $schema
            ->components([
                Select::make('exhibit_id')
                    ->options(
                        $exhibits->pluck('name', 'id')->toArray()
                    )
                    ->required(),
                FileUpload::make('path')
                    ->name('картиночка')
                    ->required()
                    ->columnSpanFull()
                    ->disk('public')
                    ->image()
                    ->directory('exhibit-photos')
                    ->visibility('public')
            ]);
    }
}
