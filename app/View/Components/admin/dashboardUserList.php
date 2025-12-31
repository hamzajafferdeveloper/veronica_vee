<?php

namespace App\View\Components\admin;

use App\Service\Admin\Dashboard\UserService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dashboardUserList extends Component
{
    public $latestRecruiters;
    public $latestProfessionals;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->latestRecruiters = UserService::getLatestRecruiters('recruiter', 5);
        $this->latestProfessionals = UserService::getLatestRecruiters('professional', 5);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.dashboard-user-list', [
            'latestRecruiters' => $this->latestRecruiters,
            'latestProfessionals' => $this->latestProfessionals,
        ]);
    }
}
