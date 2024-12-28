<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Notifications\Notification;


class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('name'),
            ExportColumn::make('email'),
            ExportColumn::make('document'),
            ExportColumn::make('phoneNumbers.full_number'),
            ExportColumn::make('roles.name'),

        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'A exportação do seu usuário foi concluída e ' . number_format($export->successful_rows) . ' ' . str('campo')->plural($export->successful_rows) . ' exportados.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }
        // $recipient = auth()->user();
        // $recipient->notify(
        //     Notification::make()
        //         ->title('Exportado com sucesso')
        //         ->body($body)
        //         ->toDatabase(),
        // );

        return $body;
    }
}
