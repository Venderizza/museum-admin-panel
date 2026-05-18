<?php

namespace App\Filament\Resources\ExhibitPhotos\Pages;

use App\Filament\Resources\ExhibitPhotos\ExhibitPhotoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExhibitPhoto extends EditRecord
{
    protected static string $resource = ExhibitPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
