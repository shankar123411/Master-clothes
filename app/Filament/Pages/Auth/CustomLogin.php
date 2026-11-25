<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;

class CustomLogin extends Login
{
    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Admin ID')
            ->placeholder('Enter Admin ID')
            ->password()
            ->revealable(true)
            ->required()
            ->autocomplete('off')
            ->autofocus();
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->placeholder('Enter Password')
            ->password()
            ->revealable(true)
            ->autocomplete('new-password')
            ->required();
    }
}
