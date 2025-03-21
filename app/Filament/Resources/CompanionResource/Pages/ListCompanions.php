<?php

namespace App\Filament\Resources\CompanionResource\Pages;

use App\Filament\Resources\CompanionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanions extends ListRecords
{
    protected static string $resource = CompanionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
