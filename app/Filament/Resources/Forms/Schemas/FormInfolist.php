<?php

namespace App\Filament\Resources\Forms\Schemas;

use Filament\Infolists\Components\CodeEntry;
use Filament\Infolists\Components\TextEntry;
use Phiki\Grammar\Grammar;
use Filament\Schemas\Schema;

class FormInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('jsonSchema.name')
                    ->label('JSON Schema')
                    ->badge()
                    ->color('primary'),
                
                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->badge()
                    ->color('success'),
                    
                TextEntry::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->badge()
                    ->color('info'),
                
                CodeEntry::make('data')
                    ->label('Data Form')
                    ->grammar(Grammar::Json)
                    ->columnSpanFull(),
            ]);
    }
}
