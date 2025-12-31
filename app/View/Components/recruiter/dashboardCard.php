<?php

namespace App\View\Components\Recruiter;

use App\Http\Controllers\Recruiter\Dashboard\ProjectController;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $projectCounts;
    public $projectStats;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->projectCounts = ProjectController::getMyProjectsCount();
        $this->projectStats = ProjectController::getMyProjectsGrowth();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->projectStats);
        return view('components.recruiter.dashboard-card', [
            'myProjectsCount' => $this->projectCounts,
            'projectStats' => $this->projectStats,
        ]);
    }
}
