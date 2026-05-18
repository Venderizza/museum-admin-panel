<?php

namespace App\Filament\Resources\Exhibits\Pages;

use App\Filament\Resources\Exhibits\ExhibitResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExhibit extends EditRecord
{
    protected static string $resource = ExhibitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
