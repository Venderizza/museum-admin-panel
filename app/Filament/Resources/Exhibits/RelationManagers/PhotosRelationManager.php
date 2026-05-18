<?php

namespace App\Filament\Resources\Exhibits\RelationManagers;

use App\Filament\Resources\ExhibitPhotos\ExhibitPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected static ?string $relatedResource = ExhibitPhotoResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
