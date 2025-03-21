<?php

namespace App\Filament\Resources\CompanionResource\Pages;

use App\Filament\Resources\CompanionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanion extends EditRecord
{
    protected static string $resource = CompanionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
