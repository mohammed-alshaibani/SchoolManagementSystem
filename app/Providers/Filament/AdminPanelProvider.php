<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
// use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\Users\UserResource; // adjust namespace to your resource
use Filament\Navigation\MenuItem;
use Filament\Actions\Action;
use Kenepa\TranslationManager\TranslationManagerPlugin;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
// use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use BezhanSalleh\LanguageSwitch\Enums\Placement;
use Filament\SpatieLaravelTranslatablePlugin\Plugin as TranslatablePlugin;
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugin(
                
                TranslationManagerPlugin::make()
                    ->availableLocales([
                        ['code' => 'ar', 'name' => 'العربية', 'flag' => 'sa'],
                        ['code' => 'en', 'name' => 'English', 'flag' => 'gb'],
                    ])
                    ->languageSwitcher(true)
                    ->languageSwitcherRenderHook('panels::user-menu.before')
                    ->navigationGroup('Settings')
                    ->navigationIcon('heroicon-o-globe-alt')
                    ->showFlags(true)
                    ->disableKeyAndGroupEditing(false)
                    ->quickTranslateNavigationRegistration(true)
                    
                    
                    
            )
            
            ->databaseNotifications()
            ->profile()
            ->userMenuItems([
                Action::make('settings')
                ->url(fn (): string => UserResource::getUrl())
                ->icon('heroicon-o-cog-6-tooth'),
                // Action::make('lockSession')
                //     ->url(fn (): string => route('lock-session'))
                //     ->postToUrl()
            ])
            ->defaultAvatarProvider(BoringAvatarsProvider::class)
            ->databaseNotificationsPolling('10s')
            ->databaseNotifications()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])

            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
           ->userMenuItems([
                MenuItem::make()
                ->label('Edit profile')
                ->icon('heroicon-o-user')
                ->url(fn (): string => UserResource::getUrl('edit', ['record' => (string) auth()->id()]))
                ->sort(5),

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
            ]);
            


    }
}
