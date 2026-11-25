<?php

namespace App\Filament\Resources\Colors\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;

class ColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                ColorPicker::make('hex')->default('#db2777'),
            ]);
    }
}
