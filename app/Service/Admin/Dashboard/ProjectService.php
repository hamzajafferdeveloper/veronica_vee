<?php

namespace App\Service\Admin\Dashboard;

use App\Models\Project;

class ProjectService
{
    public static function getTotalProjects(): int
    {
        return Project::count();
    }

    public static function getProjectsLast30Days(): int
    {
        return Project::where('created_at', '>=', now()->subDays(30))->count();
    }

    public static function getProjectGrowthPercentage(): array
    {
        $current = Project::where('created_at', '>=', now()->subDays(30))->count();
        $previous = Project::whereBetween('created_at', [
            now()->subDays(60),
            now()->subDays(30),
        ])->count();

        if ($previous === 0) {
            return [
                'percentage' => $current > 0 ? 100 : 0,
                'trend' => 'up',
            ];
        }

        $percentage = (($current - $previous) / $previous) * 100;

        return [
            'percentage' => round($percentage, 2),
            'trend' => $percentage >= 0 ? 'up' : 'down',
        ];
    }
}
