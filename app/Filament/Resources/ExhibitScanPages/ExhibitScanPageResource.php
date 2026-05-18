<?php

namespace App\Filament\Resources\ExhibitScanPages;

use App\Filament\Resources\ExhibitScanPages\Pages\CreateExhibitScanPage;
use App\Filament\Resources\ExhibitScanPages\Pages\EditExhibitScanPage;
use App\Filament\Resources\ExhibitScanPages\Pages\ListExhibitScanPages;
use App\Filament\Resources\ExhibitScanPages\Schemas\ExhibitScanPageForm;
use App\Filament\Resources\ExhibitScanPages\Tables\ExhibitScanPagesTable;
use App\Models\ExhibitScanPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExhibitScanPageResource extends Resource
{
    protected static ?string $model = ExhibitScanPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'File';

    public static function form(Schema $schema): Schema
    {
        return ExhibitScanPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExhibitScanPagesTable::configure($table);
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
            'index' => ListExhibitScanPages::route('/'),
            'create' => CreateExhibitScanPage::route('/create'),
            'edit' => EditExhibitScanPage::route('/{record}/edit'),
        ];
    }
}
