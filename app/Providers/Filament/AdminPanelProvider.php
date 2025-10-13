<?php

namespace App\Providers\Filament;

use App\Models\Student;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarCollapsibleOnDesktop()
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('SDN CIPINANG MELAYU 07')
            ->sidebarWidth('15rem')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,  // Your custom dashboard
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $this->buildCustomNavigation($builder);
            })
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

    protected function buildCustomNavigation(NavigationBuilder $builder): NavigationBuilder
    {
        // Add Dashboard first - UNCOMMENTED
        $builder->group('Dashboard', [
            NavigationItem::make('Dashboard')
                ->icon('heroicon-o-home')
                ->url('/admin')
                ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard')),
        ]);

        // Add Karyawan group
        $builder->group('Karyawan', [
            NavigationItem::make('Data Karyawan')
                ->icon('heroicon-o-user')
                ->url('/admin/data-karyawan'),
        ]);

        // Add Download group
        $builder->group('Download', [
            NavigationItem::make('Data Download')
                ->icon('heroicon-o-link')
                ->url('/admin/downloads'),
        ]);

        // Add management group
        $builder->group('Siswa', [
            NavigationItem::make('Data Siswa')
                ->icon('heroicon-o-users')
                ->url('/admin/students'),
        ]);

        //Informasi Alumni
        $builder->group('Alumni', [
            NavigationItem::make('Data Alumni')
                ->icon('heroicon-o-link')
                ->url('/admin/students/alumni'),
        ]);

        if (auth()->user()?->is_superuser) {
            $builder->group('Monitor', [
                NavigationItem::make('Log')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->url('/admin/activity-logs'),
            ]);
        }

        $builder->group('Verifikasi', [
            NavigationItem::make('Verifikasi Data Siswa')
                ->icon('heroicon-o-check-badge')
                ->url('/admin/data-karyawan/verifikasi')
                ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.resources.data-karyawan.verifikasi'))
                ->badge(fn() => \App\Models\DataKaryawan::where('is_verified', false)->count())
        ]);

        return $builder;
    }
}