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
                Pages\Dashboard::class,
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
        // Add Dashboard first
        // $builder->group('Dashboard', [
        //     NavigationItem::make('Dashboard')
        //         ->icon('heroicon-o-home')
        //         ->url('/admin')
        //         ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard')),
        // ]);

        // Add Dashboard first
        $builder->group('Guru', [
            NavigationItem::make('Manajemen Guru')
                ->icon('heroicon-o-user')
                ->url('/admin/teachers')
                ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard')),
        ]);

        // Add Dashboard first
        $builder->group('Download', [
            NavigationItem::make('Manajemen Download')
                ->icon('heroicon-o-link')
                ->url('/admin/downloads')
                ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard')),
        ]);



        // Get all academic years and create single collapsible group
        // $academicYears = Student::distinct('tahun_ajar')
        //     ->orderBy('tahun_ajar', 'desc')
        //     ->pluck('tahun_ajar');

        // $tahunAjaranItems = [];
        // foreach ($academicYears as $year) {
        //     $studentCount = Student::where('tahun_ajar', $year)->count();

        //     $tahunAjaranItems[] = NavigationItem::make("Data Siswa {$year}")
        //         ->icon('heroicon-o-academic-cap')
        //         ->url("/admin/students?tableFilters[tahun_ajar][value]={$year}")
        //         ->badge($studentCount);
        // }

        // $builder->group(group: 'Tahun Ajaran', $tahunAjaranItems);

        // Add management group
        $builder->group('Manajemen', [
            NavigationItem::make('Data Siswa')
                ->icon('heroicon-o-users')
                ->url('/admin/students'),
        ]);

        //Informasi Alumni
        $builder->group('Alumni', [
            NavigationItem::make('Informasi Alumni')
                ->icon('heroicon-o-link')
                ->url('/admin/students/alumni')
                ->isActiveWhen(fn(): bool => request()->routeIs('filament.admin.pages.dashboard')),
        ]);

        $builder->group('Monitor', [
            NavigationItem::make('Log')
                ->icon('heroicon-o-users')
                ->url('/admin/activity-logs'),
        ]);

        return $builder;
    }
}