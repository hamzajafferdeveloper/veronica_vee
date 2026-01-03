<?php

namespace App\View\Components\Frontend;

use App\Service\Admin\Dashboard\ProjectService;
use App\Service\Admin\Dashboard\UserService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModelRecruiterNo extends Component
{
    public $noOfProjects;

    public $noOfRecruiters;

    public $noOfModels;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->noOfProjects = ProjectService::getTotalProjects();
        $this->noOfRecruiters = UserService::getTotalRecruiters();
        $this->noOfModels = UserService::getTotalProfessionals();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.model-recruiter-no', [
            'noOfProjects' => $this->noOfProjects,
            'noOfRecruiters' => $this->noOfRecruiters,
            'noOfModels' => $this->noOfModels,
        ]);
    }
}
