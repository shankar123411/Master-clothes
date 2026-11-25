<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('product')->required(),
                TextInput::make('color')->required(),
                TextInput::make('size')->required(),
                TextInput::make('quantity')->numeric()->default(1)->required(),
                TextInput::make('phone')->tel()->required(),
                Select::make('status')
                    ->options([
                        'New Inquiry' => 'New Inquiry',
                        'Contacted' => 'Contacted',
                        'Converted' => 'Converted',
                        'Cancelled' => 'Cancelled',
                    ])
                    ->default('New Inquiry')
                    ->required(),
            ]);
    }
}
