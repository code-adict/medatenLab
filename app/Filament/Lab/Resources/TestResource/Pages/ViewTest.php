<?php

namespace App\Filament\Lab\Resources\TestResource\Pages;

use App\Filament\Lab\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTest extends ViewRecord
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
