<?php

namespace App\Http\Controllers\Recruiter\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public static function getMyProjectsCount()
    {
        $count = Project::where('recruiter_id', auth()->id())->count();
        return $count;
    }

    public static function getMyProjectsLast30Days(): array
    {
        $startDate = Carbon::now()->subDays(29)->startOfDay();

        $projects = Project::where('recruiter_id', auth()->id())
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $data = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $data[] = [
                'date' => $date,
                'total' => $projects[$date]->total ?? 0,
            ];
        }

        return $data;
    }

    public static function getMyProjectsGrowth(): array
    {
        $currentStart = now()->subDays(29)->startOfDay();
        $previousStart = now()->subDays(59)->startOfDay();
        $previousEnd = now()->subDays(30)->endOfDay();

        $current = Project::where('recruiter_id', auth()->id())
            ->where('created_at', '>=', $currentStart)
            ->count();

        $previous = Project::where('recruiter_id', auth()->id())
            ->whereBetween('created_at', [$previousStart, $previousEnd])
            ->count();

        if ($previous === 0) {
            return [
                'current' => $current,
                'previous' => $previous,
                'percentage' => 100,
                'direction' => 'up',
            ];
        }

        $percentage = round((($current - $previous) / $previous) * 100, 2);

        return [
            'current' => $current,
            'previous' => $previous,
            'percentage' => abs($percentage),
            'direction' => $percentage >= 0 ? 'up' : 'down',
        ];
    }
}
