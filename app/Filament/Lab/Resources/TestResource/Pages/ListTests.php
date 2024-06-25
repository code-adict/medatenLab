<?php

namespace App\Filament\Lab\Resources\TestResource\Pages;

use App\Filament\Lab\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTests extends ListRecords
{
    protected static string $resource = TestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
