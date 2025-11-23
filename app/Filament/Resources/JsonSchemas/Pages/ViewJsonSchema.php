<?php

namespace App\Filament\Resources\JsonSchemas\Pages;

use App\Filament\Resources\JsonSchemas\JsonSchemaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJsonSchema extends ViewRecord
{
    protected static string $resource = JsonSchemaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
