<?php

namespace App\Filament\Lab\Resources\SlotResource\Pages;

use App\Filament\Lab\Resources\SlotResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSlot extends EditRecord
{
    protected static string $resource = SlotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
