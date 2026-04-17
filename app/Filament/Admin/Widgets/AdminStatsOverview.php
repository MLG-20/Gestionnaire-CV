<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class AdminStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected static bool $isLazy = false;
    
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', Cache::remember('users_count', 3600, fn() => User::where('is_admin', false)->count()))
                ->description('Utilisateurs actifs')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Experiences', Cache::remember('experiences_count', 3600, fn() => Experience::count()))
                ->description('Expériences enregistrées')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('info'),
            Stat::make('Total Educations', Cache::remember('educations_count', 3600, fn() => Education::count()))
                ->description('Formations enregistrées')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning'),
            Stat::make('Total Skills', Cache::remember('skills_count', 3600, fn() => Skill::count()))
                ->description('Compétences enregistrées')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('danger'),
        ];
    }
}
