<?php

namespace App\Filament\Lab\Resources\TestResource\Pages;

use App\Filament\Lab\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTest extends EditRecord
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
