<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component as Livewire;

class PostalCode extends TextInput
{
    public function viaCep(
        string $errorMessage = 'CEP inválido!',
        array $setFields = []
    ): static {

        $viaCepRequest = function (
            $state,
            $livewire,
            $set,
            $component,
            string $errorMessage,
            array $setFields
        ) {
            $livewire->validateOnly($component->getKey());
            $request = Http::get("viacep.com.br/ws/$state/json/")->json();

            foreach ($setFields as $key => $value) {
                $set($key, $request[$value] ?? null);
            }

            if (Arr::has($request, 'erro')) {
                throw ValidationException::withMessages([
                    $component->getKey() => $errorMessage,
                ]);
            }
        };

        $this->mask('99999-999')
            ->minLength(9)
            ->required()
            ->suffixAction(
                Action::make('search-action')
                    ->label('Buscar CEP')
                    ->icon('heroicon-o-magnifying-glass')
                    ->action(
                        function ($state, Livewire $livewire, Set $set, $component) use ($errorMessage, $setFields, $viaCepRequest) {
                            $viaCepRequest($state, $livewire, $set, $component, $errorMessage, $setFields);
                        }
                    )
            );
        return $this;
    }
}
