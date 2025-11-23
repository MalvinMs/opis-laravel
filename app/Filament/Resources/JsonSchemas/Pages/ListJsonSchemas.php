<?php

namespace App\Filament\Resources\JsonSchemas\Pages;

use App\Filament\Resources\JsonSchemas\JsonSchemaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJsonSchemas extends ListRecords
{
    protected static string $resource = JsonSchemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
