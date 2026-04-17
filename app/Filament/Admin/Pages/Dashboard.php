<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Admin\Widgets\AdminStatsOverview::class,
            \App\Filament\Admin\Widgets\UsersChart::class,
            \App\Filament\Admin\Widgets\SkillsLevelChart::class,
        ];
    }
}
