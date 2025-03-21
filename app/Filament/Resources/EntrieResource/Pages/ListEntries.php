<?php

namespace App\Filament\Resources\EntrieResource\Pages;

use App\Filament\Resources\EntrieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntries extends ListRecords
{
    protected static string $resource = EntrieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
