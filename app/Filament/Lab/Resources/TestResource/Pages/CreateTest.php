<?php

namespace App\Filament\Lab\Resources\TestResource\Pages;

use App\Filament\Lab\Resources\TestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTest extends CreateRecord
{
    protected static string $resource = TestResource::class;
}
