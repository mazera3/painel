<?php

namespace App\Filament\Pages\Auth;

use App\Forms\Components\PostalCode;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Support\Enums\Alignment;

class EditProfile extends BaseEditProfile
{
    public function getLayout(): string
    {
        return static::$layout ?? (static::isSimple() ? 'filament-panels::components.layout.index' : 'filament-panels::components.layout.simple');
    }

    public function getView(): string
    {
        return static::$view ?? 'filament.pages.auth.edit-profile';
    }

    public static function isSimple(): bool
    {
        return Filament::isProfilePageSimple();
    }

    public static function getLabel(): string
    {
        return __('filament-panels::pages/auth/edit-profile.label');
    }

    public static function getSlug(): string
    {
        return static::$slug ?? 'me';
    }

    protected function hasFullWidthFormActions(): bool
    {
        return false;
    }

    public function getFormActionsAlignment(): string | Alignment
    {
        return Alignment::End;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informações Pessoais')
                    ->aside()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getDocumentFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getAddressFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
            ]);
    }

    protected function getDocumentFormComponent(): Component
    {
        return TextInput::make('document')
            ->label('CPF')
            ->mask('999.999.999-99')
            ->disabled()
            // ->required()
            ->maxLength(14)
            ->unique(true);
    }

    protected function getAddressFormComponent(): Component
    {
        return Fieldset::make('Address')
            ->relationship('address')
            ->schema([
                PostalCode::make('postal_code')
                    ->viaCep(
                        setFields: [
                            'address'        => 'logradouro',
                            'number'        => 'numero',
                            'neighborhood'  => 'bairro',
                            'city'          => 'localidade',
                            'uf'         => 'uf',
                        ]
                    ),
                TextInput::make('address'),
                TextInput::make('number'),
                TextInput::make('complement'),
                TextInput::make('neighborhood'),
                TextInput::make('city'),
                TextInput::make('uf'),
            ]);
    }
}
