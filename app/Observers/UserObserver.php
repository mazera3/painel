<?php

namespace App\Observers;

use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

use function Laravel\Prompts\warning;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Notification::make()
            ->warning()
            ->title('Bem vindo ao sistema')
            ->body('Atualiza seu perfil');
            // ->actions([
            //     Action::make('view')
            //         ->button()
            //         ->url(route('filament.admin.pages.edit-profile')),
            // ])
            // ->sendToDatabase($user);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
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
        Notification::make()
            ->title('Account Updated')
            ->body('deletado com sucesso')
            ->sendToDatabase($user);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
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
