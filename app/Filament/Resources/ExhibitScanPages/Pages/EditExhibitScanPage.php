<?php

namespace App\Filament\Resources\ExhibitScanPages\Pages;

use App\Filament\Resources\ExhibitScanPages\ExhibitScanPageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExhibitScanPage extends EditRecord
{
    protected static string $resource = ExhibitScanPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
