<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Skill;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class SkillsLevelChart extends ChartWidget
{
    protected static ?string $heading = 'Compétences par niveau';
    protected static ?string $description = 'Répartition des niveaux de compétence';
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'md:col-span-1';
    
    protected static bool $isLazy = false;
    
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        return Cache::remember('skills_level_chart_data', 3600, function () {
            $data = Skill::selectRaw('level, COUNT(*) as count')
                ->groupBy('level')
                ->get();

            $levels = [
                'beginner' => 'Débutant',
                'intermediate' => 'Intermédiaire',
                'advanced' => 'Avancé',
                'expert' => 'Expert',
            ];

            return [
                'datasets' => [
                    [
                        'label' => 'Nombre de compétences',
                        'data' => $data->pluck('count')->toArray(),
                        'backgroundColor' => [
                            '#94a3b8',  // beginner - gray
                            '#3b82f6',  // intermediate - blue
                            '#f59e0b',  // advanced - orange
                            '#ef4444',  // expert - red
                        ],
                        'borderColor' => [
                            '#64748b',
                            '#1e40af',
                            '#d97706',
                            '#dc2626',
                        ],
                        'borderWidth' => 2,
                    ],
                ],
                'labels' => $data->map(fn($item) => $levels[$item->level] ?? $item->level)->toArray(),
            ];
        });
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
