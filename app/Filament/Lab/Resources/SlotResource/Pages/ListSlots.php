<?php

namespace App\Filament\Lab\Resources\SlotResource\Pages;

use App\Filament\Lab\Resources\SlotResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSlots extends ListRecords
{
    protected static string $resource = SlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
