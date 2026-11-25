<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

class CustomEditProfile extends EditProfile
{
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Admin ID')
            ->required()
            ->maxLength(255)
            ->unique(ignoreRecord: true)
            ->live(debounce: 500);
    }
}
