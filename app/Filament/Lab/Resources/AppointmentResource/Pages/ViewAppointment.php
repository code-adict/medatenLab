<?php

namespace App\Filament\Lab\Resources\AppointmentResource\Pages;

use App\Filament\Lab\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAppointment extends ViewRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
