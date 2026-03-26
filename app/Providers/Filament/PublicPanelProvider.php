<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use App\Filament\Widgets\DashboardAnggaranTable;
use App\Filament\Widgets\DashboardBalihoMap;
use App\Filament\Widgets\JenisKontenChart;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PublicPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('public')
            ->path('public')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Public/Resources'), for: 'App\\Filament\\Public\\Resources')
            ->discoverPages(in: app_path('Filament/Public/Pages'), for: 'App\\Filament\\Public\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->sidebarCollapsibleOnDesktop()

            ->discoverWidgets(in: app_path('Filament/Public/Widgets'), for: 'App\\Filament\\Public\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                Widgets\StatsOverviewWidget::class,
                // Widgets\FilamentInfoWidget::class,
                DashboardBalihoMap::class,
                // DashboardAnggaranTable::class,
                // JenisKontenChart::class,
                \App\Filament\Widgets\JadwalBaliho::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                // AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                // Authenticate::class,
            ])
            ->plugins([
                // FilamentShieldPlugin::make(),
                FilamentFullCalendarPlugin::make()
                // ->schedulerLicenseKey()
                // ->selectable()
                // ->editable()
                // ->timezone()
                // ->locale()
                // ->plugins()
                // ->config()
            ])
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('Login Admin')
                    ->url(fn(): string => route('filament.admin.auth.login')) // Direct link ke login admin
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->sort(10) // Menentukan posisi (makin besar makin bawah)
                ])  
            ->topNavigation()
            // ->renderHook(

            //     'panels::public.before', // Menaruh tombol sebelum menu user (jika ada)
            //     fn (): string => view('filament.components.login-button'),
            // )
        ;
    }
}
