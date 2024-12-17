<?php

namespace App\Livewire;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Joaopaulolndev\FilamentEditProfile\Concerns\HasSort;

class AddressUserProfile extends Component implements HasForms
{
    use InteractsWithForms;
    use HasSort;

    public ?array $data = [];

    protected static int $sort = 15;

    // public Model $adderess;

    public function mount(): void
    {
        // $this->address = Adderess::find(auth()-user()->id);
        // $this->form->fill($this->address->attributesToArray);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section::make('Custom component')
                //     ->aside()
                //     ->description('Custom component description')
                //     ->schema([
                //         // plugin postalcode
                //         PostalCode::make('postal_code')
                //             ->helperText('Digite seu CEP e clique na lupa')
                //             ->label('CEP')
                //             ->validationAttribute('CEP')
                //             ->required()
                //             ->viaCep(
                //                 setFields: [
                //                     'street' => 'logradouro',
                //                     'number' =>  'numero',
                //                     'neighborhood' => 'bairro',
                //                     'city' => 'localidade',
                //                     'state' => 'uf',
                //                 ]
                //             ),
                //         Forms\Components\TextInput::make('street')
                //             ->columnSpanFull()
                //             ->readOnly()
                //             ->label('Endereço')
                //             ->required(),
                //         Forms\Components\TextInput::make('number')
                //             ->label('Número')
                //             ->required()
                //             ->extraAlpineAttributes([
                //                 'x-on:cep.window' => "\$el.focus()",
                //             ]),
                //         Forms\Components\TextInput::make('complement')
                //             ->label('Complemento'),
                //         Forms\Components\TextInput::make('neighborhood')
                //             ->readOnly()
                //             ->label('Bairro')
                //             ->required(),
                //         Forms\Components\TextInput::make('city')
                //             ->readOnly()
                //             ->label('Cidade')
                //             ->required(),
                //         Forms\Components\TextInput::make('state')
                //             ->readOnly()
                //             ->label('Estado')
                //             ->minLength(2)
                //             ->maxLength(2)
                //             ->required(),
                //     ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        // $this->address->update($data);
        // Notification::make()
        // ->success()
        // ->title('Endereço salvo com sucesso')
        // ->send();
    }

    public function render(): View
    {
        return view('livewire.address-user-profile');
    }
}
