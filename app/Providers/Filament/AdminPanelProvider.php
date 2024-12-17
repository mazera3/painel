<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use Filament\Forms\Components\Field;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\Column;
use Filament\Widgets;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Filament\Navigation\MenuItem;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Rmsramos\Activitylog\ActivitylogPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            // ->sidebarCollapsibleOnDesktop()
            ->bootUsing(function () {
                Field::configureUsing(function (Field $field) {
                    $field->translateLabel();
                });

                Column::configureUsing(function (Column $column) {
                    $column->translateLabel();
                });
            })
            ->sidebarFullyCollapsibleOnDesktop()
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            # **** personalização ******
            ->registration()
            // ->profile(isSimple: false)
            // ->profile(EditProfile::class)
            ->databaseNotifications()
            ->passwordReset()
            ->authGuard('web')
            ->emailVerification()
            // ->topNavigation()
            ->brandName('BibeLivre')
            ->brandLogo(fn(): View => view('filament.logo'))
            ->brandLogoHeight(fn() => Auth::check() ? '32px' : '64px')
            ->viteTheme('resources/css/filament/admin/theme.css')
            // ->brandLogo(asset('images/computador.svg'))
            // ->darkModeBrandLogo(asset('images/linkedin.jpg'))
            ->favicon(asset('images/favicon.ico'))
            # *****************
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setTitle('Meu Perfil')
                    ->setNavigationLabel('Meu Perfil')
                    ->setNavigationGroup('Perfil')
                    ->setIcon('heroicon-o-user')
                    ->setSort(10)
                    // ->shouldRegisterNavigation(false)
                    ->shouldShowDeleteAccountForm(true)
                    ->customProfileComponents([
                        \App\Livewire\AddressUserProfile::class,
                    ])
                    ->shouldShowBrowserSessionsForm(true)
                    ->shouldShowAvatarForm(
                        value: true,
                        directory: 'avatars', // image will be stored in 'storage/app/public/avatars
                        rules: 'mimes:jpeg,png|max:1024' //only accept jpeg and png files with a maximum size of 1MB
                    )
            ])
            ->plugins([
                ActivitylogPlugin::make()
                ->label('Log')
                ->pluralLabel('Logs')
                ->navigationGroup('Configurações')
                ->navigationIcon('heroicon-o-shield-exclamation')
                ->navigationCountBadge(true)
                ->navigationSort(3),
            ]);
    }
}
