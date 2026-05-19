<?php

namespace App\Filament\Resources\ExhibitScanPages\Schemas;

use App\Models\Exhibit;
use App\Models\ExhibitScanPageStatus;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ExhibitScanPageForm
{
    public static function configure(Schema $schema): Schema
    {
        $exhibits = Exhibit::all();
        $statuses = ExhibitScanPageStatus::whereIn('name', [
            'В ожидании одобрения',
            'Одобрено',
            'Отклонено'
        ]);

        return $schema
            ->components([
                Select::make('exhibit_id')
                    // ->required()
                    ->label('экспонат')
                    ->options(
                        $exhibits->pluck('name', 'id')->toArray()
                    ),
         
                FileUpload::make('path')
                    ->required()
                    ->columnSpanFull()
                    ->disk('public')
                    ->image()
                    ->directory('exhibit-photos')
                    ->visibility('public'),
 
                Textarea::make('scan_result')
                    ->label('Результат распознавания')
                    ->columnSpanFull()
                    ->autosize()
                    ->helperText('Проверьте результат перед одобрением')

                    ->visible(fn ($record) =>
                        $record &&
                        filled($record->scan_result)
                    )

                    ->disabled(fn ($record) =>
                        $record &&
                        $record->exhibit_scan_page_status_id !==
                            ExhibitScanPageStatus::VERIFYING
                    ),

                Select::make('exhibit_scan_page_status_id')
                    ->label('Статус')
                    ->options(
                        ExhibitScanPageStatus::query()
                            ->whereIn('id', [
                                ExhibitScanPageStatus::VERIFYING,
                                ExhibitScanPageStatus::VERIFIED,
                                ExhibitScanPageStatus::REFUSED,
                            ])
                            ->pluck('name', 'id')
                            ->toArray()
                    )

                    ->visible(fn ($record) =>
                        $record &&
                        filled($record->scan_result)
                    )

                    ->disabled(fn ($record) =>
                        $record &&
                        $record->exhibit_scan_page_status_id !==
                            ExhibitScanPageStatus::VERIFYING
                    ),
            ]);
    }
}
