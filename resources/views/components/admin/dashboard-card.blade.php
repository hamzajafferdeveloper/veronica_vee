<div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Users</p>
                        <h6 class="mb-0">{{ $totalNoOfUser }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span
                        class="d-inline-flex align-items-center gap-1 {{ $userGrowthPercentage['trend'] === 'up' ? 'text-success-main' : 'text-danger-main' }}">
                        <iconify-icon icon="bxs:{{ $userGrowthPercentage['trend'] }}-arrow"
                            class="text-xs"></iconify-icon> {{ $userGrowthPercentage['percentage'] }} %
                    </span>
                    Last 30 days
                </p>
            </div>
        </div><!-- user card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-2 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Professionals</p>
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
                    Last 30 days
                </p>
            </div>
        </div><!-- professional card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-3 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Recruiters</p>
                        <h6 class="mb-0">{{ $totalRecruiters }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fluent:people-20-filled"
                            class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span
                        class="d-inline-flex align-items-center gap-1 {{ $recruiterGrowthPercentage['trend'] === 'up' ? 'text-success-main' : 'text-danger-main' }}">
                        <iconify-icon icon="bxs:{{ $recruiterGrowthPercentage['trend'] }}-arrow"
                            class="text-xs"></iconify-icon> {{ $recruiterGrowthPercentage['percentage'] }} %
                    </span>
                    Last 30 days
                </p>
            </div>
        </div><!-- recruiter card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-4 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Projects</p>
                        <h6 class="mb-0">{{ $totalProjects }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="solar:documents-bold-duotone" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 {{ $projectGrowthPercentage["trend"] === "up" ? 'text-success-main' : 'text-danger-main' }}">
                        <iconify-icon icon="bxs:{{ $projectGrowthPercentage['trend'] }}-arrow" class="text-xs"></iconify-icon> {{ $projectGrowthPercentage['percentage'] }} %
                    </span>
                    Last 30 days
                </p>
            </div>
        </div><!-- total project card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-5 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Expense</p>
                        <h6 class="mb-0">$30,000</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fa6-solid:file-invoice-dollar"
                            class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$5,000
                    </span>
                    Last 30 days expense
                </p>
            </div>
        </div><!-- card end -->
    </div>
</div>
