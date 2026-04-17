<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class UsersChart extends ChartWidget
{
    protected static ?string $heading = 'Utilisateurs par mois';
    protected static ?string $description = 'Évolution des inscriptions';
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'md:col-span-2';
    
    protected static bool $isLazy = false;
    
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        return Cache::remember('users_chart_data', 3600, function () {
            $data = User::where('is_admin', false)
                ->where('created_at', '>=', now()->subMonths(6))
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month')
                ->selectRaw('COUNT(*) as count')
                ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m")')
                ->orderBy('month')
                ->get();

            return [
                'datasets' => [
                    [
                        'label' => 'Nouveaux utilisateurs',
                        'data' => $data->pluck('count')->toArray(),
                        'borderColor' => '#3b82f6',
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'tension' => 0.3,
                        'fill' => true,
                    ],
                ],
                'labels' => $data->pluck('month')->toArray(),
            ];
        });
    }

    protected function getType(): string
    {
        return 'line';
    }
}
