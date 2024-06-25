<?php

namespace App\Filament\Lab\Resources\AppointmentResource\Pages;

use App\Filament\Lab\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
