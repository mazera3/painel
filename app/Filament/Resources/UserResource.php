<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Forms\Components\PostalCode;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;


    public static function getModelLabel(): string
    {
        return __('User');
    }

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'Usuário';
    protected static ?string $pluralModelLabel = 'Usuários';
    protected static ?string $navigationLabel = 'Usuários';

    protected static ?string $slug = 'users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('document')
                    ->label('CPF')
                    ->required()
                    ->maxLength(14)
                    ->mask('999.999.999-99')
                    ->unique(ignoreRecord:true),
                // Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->confirmed()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                    ->dehydrated(fn(?string $state): bool => filled($state))
                    ->required(fn(string $operation): bool => $operation === 'create'),
                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->maxLength(255)
                    ->same('password'),
                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->relationship(
                        'roles',
                        'name',
                        fn(Builder $query) => auth()->user()->hasRole('Admin') ? null : $query->where('name', '!=', 'Admin')
                    )
                    ->preload()
                    ->multiple()
                    ->optionsLimit(5)
                    ->columns(),
                Forms\Components\Section::make('Endereço')
                    // Forms\Components\Fieldset::make('Endereço')
                    ->relationship('address')
                    ->columns()
                    ->schema([
                        PostalCode::make('postal_code')
                            ->helperText('Digite seu CEP e clique na lupa')
                            ->label('CEP')
                            ->validationAttribute('CEP')
                            ->viaCep(
                                setFields: [
                                    'rua'           => 'logradouro',
                                    'number'        => 'numero',
                                    'complement'    => 'Rua',
                                    'bairro'        => 'bairro',
                                    'city'          => 'localidade',
                                    'uf'            => 'uf',
                                ]
                            ),
                        Forms\Components\TextInput::make('rua')
                            ->columnSpanFull()
                            ->label('Rua'),
                        Forms\Components\TextInput::make('number')
                            ->label('Número')
                            ->extraAlpineAttributes([
                                'x-on:cep.window' => "\$el.focus()",
                            ]),
                        Forms\Components\TextInput::make('complement')
                            ->label('Complemento'),
                        Forms\Components\TextInput::make('bairro')
                            ->label('Bairro'),
                        Forms\Components\TextInput::make('city')
                            ->label('Cidade'),
                        Forms\Components\TextInput::make('uf')
                            ->label('Estado')
                            ->minLength(2)
                            ->maxLength(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return auth()->user()->hasRole('Admin')
            ? parent::getEloquentQuery()
            : parent::getEloquentQuery()->whereHas(
                'roles',
                fn(Builder $query) => $query->where('name', '!=', 'Admin')
            );
    }
}
