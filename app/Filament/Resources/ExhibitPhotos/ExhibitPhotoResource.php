<?php

namespace App\Filament\Resources\ExhibitPhotos;

use App\Filament\Resources\ExhibitPhotos\Pages\CreateExhibitPhoto;
use App\Filament\Resources\ExhibitPhotos\Pages\EditExhibitPhoto;
use App\Filament\Resources\ExhibitPhotos\Pages\ListExhibitPhotos;
use App\Filament\Resources\ExhibitPhotos\Schemas\ExhibitPhotoForm;
use App\Filament\Resources\ExhibitPhotos\Tables\ExhibitPhotosTable;
use App\Models\ExhibitPhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExhibitPhotoResource extends Resource
{
    protected static ?string $model = ExhibitPhoto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static bool $shouldRegisterNavigation = false;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canAccess(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return ExhibitPhotoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExhibitPhotosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExhibitPhotos::route('/'),
            'create' => CreateExhibitPhoto::route('/create'),
            'edit' => EditExhibitPhoto::route('/{record}/edit'),
        ];
    }
}
