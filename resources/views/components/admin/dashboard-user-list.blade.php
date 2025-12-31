<div class="col-xxl-9 col-xl-12">
    <div class="card h-100">
        <div class="card-body p-24">

            <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab"
                            aria-controls="pills-to-do-list" aria-selected="true">
                            Latest Recruiters
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab"
                            aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                            Latest Professionals
                        </button>
                    </li>
                </ul>
                <a href="javascript:void(0)" id="viewAllBtn"
                    class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                    View All
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                </a>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel"
                    aria-labelledby="pills-to-do-list-tab" tabindex="0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Users </th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($latestRecruiters as $recruiter)
                                    @php
                                        // Use recruiter->avatar if exists, otherwise fallback
                                        $avatar = $recruiter->recruiter?->avatar
                                            ? 'storage/' . $recruiter->recruiter->avatar
                                            : 'assets/images/User.png';
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($avatar) }}" alt=""
                                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium">
                                                        {{ $recruiter->first_name ?? '' }}
                                                        {{ $recruiter->last_name ?? '' }}</h6>
                                                    <span
                                                        class="text-sm text-secondary-light fw-medium">{{ $recruiter->email ?? '' }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{ $recruiter->created_at->diffForHumans() }}</td>

                                        <td>{{ $recruiter->recruiter?->phone ?? 'N/A' }}</td>

                                        <td>{{ $recruiter->recruiter?->address ?? 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No recruiters found</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-recent-leads" role="tabpanel"
                    aria-labelledby="pills-recent-leads-tab" tabindex="0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Users </th>
                                    <th scope="col">Registered On</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col" class="text-center">Address</th>
                                </tr>
                            </thead>
                            @forelse ($latestProfessionals as $professional)
                                @php
                                    // Use professional->avatar if exists, otherwise fallback
                                    $avatar = $professional->model?->avatar
                                        ? 'storage/' . $professional->model->avatar
                                        : 'assets/images/User.png';
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($avatar) }}" alt=""
                                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                            <div class="flex-grow-1">
                                                <h6 class="text-md mb-0 fw-medium">{{ $professional->first_name ?? '' }}
                                                    {{ $professional->last_name ?? '' }}</h6>
                                                <span
                                                    class="text-sm text-secondary-light fw-medium">{{ $professional->email ?? '' }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $professional->created_at->diffForHumans() }}</td>

                                    <td>{{ $professional->model?->gender ?? 'N/A' }}</td>

                                    <td>{{ $professional->model?->location ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No professionals found</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.getElementById('viewAllBtn').addEventListener('click', function() {
            // Check which tab is active
            const recruiterTab = document.getElementById('pills-to-do-list-tab');
            const professionalTab = document.getElementById('pills-recent-leads-tab');

            if (recruiterTab.classList.contains('active')) {
                window.location.href = "{{ route('admin.recruiters.index') }}";
            } else if (professionalTab.classList.contains('active')) {
                window.location.href = "{{ route('admin.professionals.index') }}";
            }
        });
    </script>
@endpush
