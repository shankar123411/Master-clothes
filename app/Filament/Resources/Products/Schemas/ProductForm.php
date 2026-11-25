<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('category')->default('Classic'),
                TextInput::make('price')->numeric()->prefix('₹')->required(),
                TextInput::make('stock')->numeric()->default(100),
                Textarea::make('description'),
            ]);
    }
}
