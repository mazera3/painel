<?php

namespace App\Observers;

use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        activity()->log('Usuário criado');
        Notification::make()
            ->warning()
            ->title('Bem vindo ao sistema')
            ->body('Atualiza seu perfil')
            //
            ->actions([
                Action::make('view')
                    ->button()
                    ->url(route('filament.admin.pages.dashboard')),
            ])
            ->sendToDatabase($user);
            //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        activity()->log('Usuário atualizado');
        Notification::make()
            ->title('Account Updated')
            ->body('atualizado com sucesso')
            ->sendToDatabase($user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        activity()->log('Usuário excluído');
        Notification::make()
            ->title('Account Updated')
            ->body('deletado com sucesso')
            ->sendToDatabase($user);
    }

    /**
     * Handle the User "restored" event.
     */
    public function export(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
