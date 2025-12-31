<?php

namespace App\View\Components\Admin;

use App\Service\Admin\Dashboard\ProjectService;
use App\Service\Admin\Dashboard\UserService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $totalNoOfUser;
    public $totalProfessionals;
    public $totalRecruiters;
    public $totalProjects;


    public $userGrowthPercentage;
    public $professionalGrowthPercentage;
    public $recruiterGrowthPercentage;
    public $projectGrowthPercentage;


    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->totalNoOfUser = UserService::getTotalUsers();
        $this->totalProfessionals = UserService::getTotalProfessionals();
        $this->totalRecruiters = UserService::getTotalRecruiters();
        $this->totalProjects = ProjectService::getTotalProjects();

        $this->userGrowthPercentage = UserService::getUserGrowthPercentage();
        $this->professionalGrowthPercentage = UserService::getRoleGrowthPercentage('professional');
        $this->recruiterGrowthPercentage = UserService::getRoleGrowthPercentage('recruiter');
        $this->projectGrowthPercentage = ProjectService::getProjectGrowthPercentage();


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.dashboard-card', [
            'totalNoOfUser' => $this->totalNoOfUser,
            'totalProfessionals' => $this->totalProfessionals,
            'totalRecruiters' => $this->totalRecruiters,
            'totalProjects' => $this->totalProjects,

            'userGrowthPercentage' => $this->userGrowthPercentage,
            'professionalGrowthPercentage' => $this->professionalGrowthPercentage,
            'recruiterGrowthPercentage' => $this->recruiterGrowthPercentage,
            'projectGrowthPercentage' => $this->projectGrowthPercentage,
        ]);
    }
}
