<?php

namespace App\Filament\Resources\Exhibits;

use App\Filament\Resources\Exhibits\Pages\CreateExhibit;
use App\Filament\Resources\Exhibits\Pages\EditExhibit;
use App\Filament\Resources\Exhibits\Pages\ListExhibits;
use App\Filament\Resources\Exhibits\RelationManagers\PhotosRelationManager;
use App\Filament\Resources\Exhibits\Schemas\ExhibitForm;
use App\Filament\Resources\Exhibits\Tables\ExhibitsTable;
use App\Models\Exhibit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExhibitResource extends Resource
{
    protected static ?string $model = Exhibit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ExhibitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExhibitsTable::configure($table)
            ->query(Exhibit::query()->with('photos'));
    }

    public static function getRelations(): array
    {
        return [
            PhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExhibits::route('/'),
            'create' => CreateExhibit::route('/create'),
            'edit' => EditExhibit::route('/{record}/edit'),
        ];
    }
}
