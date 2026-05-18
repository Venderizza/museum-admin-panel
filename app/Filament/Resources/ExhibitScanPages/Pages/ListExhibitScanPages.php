<?php

namespace App\Filament\Resources\ExhibitScanPages\Pages;

use App\Filament\Resources\ExhibitScanPages\ExhibitScanPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExhibitScanPages extends ListRecords
{
    protected static string $resource = ExhibitScanPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
