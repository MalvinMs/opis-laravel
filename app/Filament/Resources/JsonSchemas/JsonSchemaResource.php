<?php

namespace App\Filament\Resources\JsonSchemas;

use App\Filament\Resources\JsonSchemas\Pages\CreateJsonSchema;
use App\Filament\Resources\JsonSchemas\Pages\EditJsonSchema;
use App\Filament\Resources\JsonSchemas\Pages\ListJsonSchemas;
use App\Filament\Resources\JsonSchemas\Pages\ViewJsonSchema;
use App\Filament\Resources\JsonSchemas\Schemas\JsonSchemaForm;
use App\Filament\Resources\JsonSchemas\Schemas\JsonSchemaInfolist;
use App\Filament\Resources\JsonSchemas\Tables\JsonSchemasTable;
use App\Models\JsonSchema;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JsonSchemaResource extends Resource
{
    protected static ?string $model = JsonSchema::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return JsonSchemaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JsonSchemaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JsonSchemasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJsonSchemas::route('/'),
            'create' => CreateJsonSchema::route('/create'),
            'view' => ViewJsonSchema::route('/{record}'),
            'edit' => EditJsonSchema::route('/{record}/edit'),
        ];
    }
}
