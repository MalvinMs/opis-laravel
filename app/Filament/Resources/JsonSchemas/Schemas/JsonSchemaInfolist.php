<?php

namespace App\Filament\Resources\JsonSchemas\Schemas;

use Filament\Infolists\Components\CodeEntry;
use Filament\Infolists\Components\TextEntry;
use Phiki\Grammar\Grammar;
use Filament\Schemas\Schema;

class JsonSchemaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama Schema')
                    ->size('lg')
                    ->weight('bold')
                    ->columnSpanFull(),
                
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
                
                CodeEntry::make('schema')
                    ->label('Definisi Schema JSON')
                    ->grammar(Grammar::Json)
                    ->columnSpanFull(),
            ]);
    }
}
