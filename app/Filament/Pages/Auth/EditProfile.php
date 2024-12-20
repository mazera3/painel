<?php

namespace App\Filament\Pages\Auth;

use App\Forms\Components\PostalCode;
use Filament\Facades\Filament;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
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
        return static::$slug ?? 'perfil';
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
                        $this->getAvatarFormComponent(),
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
            ->required()
            ->maxLength(14)
            ->unique(ignoreRecord:true);
    }

    protected function getAvatarFormComponent(): Component
    {
        return FileUpload::make('avatar_url')
        ->avatar()
        ->image()
        ->directory('avatars');
    }

    protected function getAddressFormComponent(): Component
    {
        return Fieldset::make('Endereço')
            ->relationship('address')
            ->schema([
                PostalCode::make('postal_code')
                    ->viaCep(
                        setFields: [
                            'rua'        => 'logradouro',
                            'number'        => 'numero',
                            'complement'    => 'Rua',
                            'bairro'  => 'bairro',
                            'city'          => 'localidade',
                            'uf'         => 'uf',
                        ]
                    ),
                TextInput::make('rua'),
                TextInput::make('number'),
                TextInput::make('complement'),
                TextInput::make('bairro'),
                TextInput::make('city'),
                TextInput::make('uf'),
            ]);
    }
}
