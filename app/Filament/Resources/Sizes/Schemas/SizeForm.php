<?php

namespace App\Filament\Resources\Sizes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class SizeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('code'),
            ]);
    }
}
