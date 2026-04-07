<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\DashboardAnggaranTable;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use App\Filament\Widgets\DashboardBalihoMap;
use App\Filament\Widgets\JadwalBaliho;
use App\Filament\Widgets\JenisKontenChart;
use App\Filament\Widgets\ManualBookWidget;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Widgets\Widget;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->favicon(asset('logo.png'))
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                ManualBookWidget::class,
                Widgets\StatsOverviewWidget::class,
                // Widgets\FilamentInfoWidget::class,
                DashboardAnggaranTable::class,
                JenisKontenChart::class,
                DashboardBalihoMap::class,
                \App\Filament\Widgets\JadwalBaliho::class,
                // \App\Filament\Pages\JadwalMedCetak::class,
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
                FilamentShieldPlugin::make(),
                FilamentFullCalendarPlugin::make()
                // ->schedulerLicenseKey()
                // ->selectable()
                // ->editable()
                // ->timezone()
                // ->locale()
                // ->plugins()
                // ->config()
            ]);
    }
}
