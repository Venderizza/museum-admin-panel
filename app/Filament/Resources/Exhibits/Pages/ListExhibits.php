<?php

namespace App\Filament\Resources\Exhibits\Pages;

use App\Filament\Resources\Exhibits\ExhibitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExhibits extends ListRecords
{
    protected static string $resource = ExhibitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
