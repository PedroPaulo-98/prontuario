<?php

namespace App\Filament\Resources\EntrieResource\Pages;

use App\Filament\Resources\EntrieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntrie extends EditRecord
{
    protected static string $resource = EntrieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
