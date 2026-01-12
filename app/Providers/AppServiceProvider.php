<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FooterSetting;
use App\Models\SiteFooterSetting;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
// use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use BezhanSalleh\LanguageSwitch\Enums\Placement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $cache;
            if ($cache === null) $cache = SiteFooterSetting::first();
            $view->with('s', $cache);
        });
    //     LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
    //     $switch
    //         ->locales(['en', 'ar'])        // the locales you support
    //         ->visible(outsidePanels: false) // optional
    //         ->renderHook('panels::global-search.after'); // optional
    // });
    // LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
    //     $switch
    //         ->locales(['en', 'ar'])
    //         ->visible(insidePanels: true, outsidePanels: true)
    //         ->outsidePanelRoutes(['login', 'home'])
    //         ->outsidePanelPlacement(Placement::BottomRight);
    // });
    LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
        $switch
            ->locales(['en', 'ar'])
            // show only inside Filament panels; change to true if you want outside too
            ->visible(insidePanels: true, outsidePanels: false)
            // hide on specific panels by panel ID, if needed:
            // ->excludes(['staff'])
            // move position in the topbar if you want:
            ->renderHook('panels::global-search.before')

        // If you want it on non-Filament pages as well, uncomment:
        ->visible(insidePanels: true, outsidePanels: true)
        ->outsidePanelRoutes(['login'])
        ->outsidePanelPlacement(Placement::BottomRight);
    });
        Gate::define('use-translation-manager', function (?User $user) {
        return $user && $user->hasRole('Admin'); // adjust to your auth
    });
    }
}
