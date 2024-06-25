<?php
namespace App\Filament\Resources\PatientResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\PatientResource;
use Illuminate\Routing\Router;


class PatientApiService extends ApiService
{
    protected static string | null $resource = PatientResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
