<?php

namespace App\Service\Admin\Dashboard;

use App\Models\User;

class UserService
{
    /* ================= BASIC COUNTS ================= */

    public static function getTotalUsers(): int
    {
        return User::count();
    }

    public static function getTotalProfessionals(): int
    {
        return User::role('professional')->count();
    }

    public static function getTotalRecruiters(): int
    {
        return User::role('recruiter')->count();
    }

    /* ================= LAST 30 DAYS ================= */

    public static function getUsersLast30Days(): int
    {
        return User::where('created_at', '>=', now()->subDays(30))->count();
    }

    public static function getUsersPrevious30Days(): int
    {
        return User::whereBetween('created_at', [
            now()->subDays(60),
            now()->subDays(30),
        ])->count();
    }

    /* ================= PERCENTAGE CHANGE ================= */

    public static function getUserGrowthPercentage(): array
    {
        $current = self::getUsersLast30Days();
        $previous = self::getUsersPrevious30Days();

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

    /* ================= ROLE BASED GROWTH ================= */

    public static function getRoleGrowthPercentage(string $role): array
    {
        $current = User::role($role)
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        $previous = User::role($role)
            ->whereBetween('created_at', [
                now()->subDays(60),
                now()->subDays(30),
            ])
            ->count();

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

    /* ================= Latest Users By Role ================= */
    public static function getLatestRecruiters(string $role = 'recruiter', int $limit = 3)
    {
        $relations = $role === 'recruiter' ? 'recruiter' : 'model';

        return User::role($role)->with($relations)->latest()->take($limit)->get();
    }
}
