<div class="row row-cols-lg-4 row-cols-sm-2  row-cols-1 gy-4">
    <div class="col">
        <a class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">{{ __('ui.total_users') }}</p>
                        <h6 class="mb-0">{{ $totalNoOfUser }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span
                        class="d-inline-flex align-items-center gap-1 {{ $userGrowthPercentage['trend'] === 'up' ? 'text-success-main' : 'text-danger-main' }}">
                        <iconify-icon icon="bxs:{{ $userGrowthPercentage['trend'] }}-arrow"
                            class="text-xs"></iconify-icon> {{ $userGrowthPercentage['percentage'] }} %
                    </span>
                    {{ __('ui.last_30_days') }}
                </p>
            </div>
        </a><!-- user card end -->
    </div>
    <div class="col">
        <a href="{{ route('admin.professionals.index') }}" class="card shadow-none border bg-gradient-start-2 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">{{ __('ui.total_professionals') }}</p>
                        <h6 class="mb-0">{{ $totalProfessionals }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span
                        class="d-inline-flex align-items-center gap-1 {{ $professionalGrowthPercentage['trend'] === 'up' ? 'text-success-main' : 'text-danger-main' }}">
                        <iconify-icon icon="bxs:{{ $professionalGrowthPercentage['trend'] }}-arrow"
                            class="text-xs"></iconify-icon> {{ $professionalGrowthPercentage['percentage'] }} %
                    </span>
                    {{ __('ui.last_30_days') }}
                </p>
            </div>
        </a><!-- professional card end -->
    </div>
    <div class="col">
        <a href="{{ route('admin.recruiters.index') }}" class="card shadow-none border bg-gradient-start-3 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">{{ __('ui.total_recruiters') }}</p>
                        <h6 class="mb-0">{{ $totalRecruiters }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span
                        class="d-inline-flex align-items-center gap-1 {{ $recruiterGrowthPercentage['trend'] === 'up' ? 'text-success-main' : 'text-danger-main' }}">
                        <iconify-icon icon="bxs:{{ $recruiterGrowthPercentage['trend'] }}-arrow"
                            class="text-xs"></iconify-icon> {{ $recruiterGrowthPercentage['percentage'] }} %
                    </span>
                    {{ __('ui.last_30_days') }}
                </p>
            </div>
        </a><!-- recruiter card end -->
    </div>
    <div class="col">
        <a href="{{ route('admin.projects.index') }}" class="card shadow-none border bg-gradient-start-4 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">{{ __('ui.total_projects') }}</p>
                        <h6 class="mb-0">{{ $totalProjects }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="solar:documents-bold-duotone"
                            class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span
                        class="d-inline-flex align-items-center gap-1 {{ $projectGrowthPercentage['trend'] === 'up' ? 'text-success-main' : 'text-danger-main' }}">
                        <iconify-icon icon="bxs:{{ $projectGrowthPercentage['trend'] }}-arrow"
                            class="text-xs"></iconify-icon> {{ $projectGrowthPercentage['percentage'] }} %
                    </span>
                    {{ __('ui.last_30_days') }}
                </p>
            </div>
        </a><!-- total project card end -->
    </div>
</div>
