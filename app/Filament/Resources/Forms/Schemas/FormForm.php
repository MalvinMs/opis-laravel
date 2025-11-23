<?php

namespace App\Filament\Resources\Forms\Schemas;

use App\Models\JsonSchema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FormForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('json_schema_id')
                    ->required()
                    ->options(JsonSchema::all()->pluck('name', 'id')),
                Textarea::make('data')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
