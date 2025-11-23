<?php

namespace App\Filament\Resources\JsonSchemas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Schemas\Schema;

class JsonSchemaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                CodeEditor::make('schema')
                ->language( Language::Json)
                ->json()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
