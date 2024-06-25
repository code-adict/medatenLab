<?php

namespace App\Filament\Lab\Resources\SlotResource\Pages;

use App\Filament\Lab\Resources\SlotResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSlot extends ViewRecord
{
    protected static string $resource = SlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
