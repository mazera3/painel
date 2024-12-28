<?php

namespace App\Filament\Imports;

use App\Models\User;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;


class UserImporter extends Importer
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->examples(['Maria Aparecida', 'João Pedro'])
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('email')
                ->examples(['maria@email.com', 'joao@email.com'])
                ->requiredMapping()
                ->rules(['required', 'email', 'max:255']),
            ImportColumn::make('document')
                ->examples(['999.999.999-99', '123.456.789-00'])
                ->rules(['max:14'])
                ->ignoreBlankState()
                ->helperText('CPF no formato: 999.999.999-99'),
            ImportColumn::make('password')
                ->examples(['12345678', 'qwe123'])
                ->requiredMapping()
                ->rules(['required', 'max:255']),

        ];
    }

    public function resolveRecord(): ?User
    {
        return User::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'email' => $this->data['email'],
        ]);

        return new User();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your user import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    public static function getOptionsFormComponents(): array
    {
        return [
            Checkbox::make('updateExisting')
                ->label('Atualizar registros existentes'),
        ];
    }

}
