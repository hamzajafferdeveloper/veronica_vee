<?php

namespace App\View\Components\Admin;

use App\Service\Admin\Dashboard\ProjectService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardProjectList extends Component
{
    public $projects;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->projects = ProjectService::getLatestProjects();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.dashboard-project-list', [
            'projects' => $this->projects,
        ]);
    }
}
