<?php

namespace App\Filament\Resources\ExhibitPhotos\Pages;

use App\Filament\Resources\ExhibitPhotos\ExhibitPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExhibitPhotos extends ListRecords
{
    protected static string $resource = ExhibitPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
