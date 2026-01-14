<div class="col-xxl-3 col-xl-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                <h6 class="mb-2 fw-bold text-lg mb-0">{{ __('ui.latest_projects') }}</h6>
                <a href="{{ route('admin.projects.index') }}" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                    {{ __('ui.view_all') }}
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                </a>
            </div>

            <div class="mt-32">

                @forelse ($projects as $project)
                    @php
                        $image = $project->image
                            ? asset('storage/' . $project->image)
                            : asset('assets/images/placeholder-1.jpg');
                    @endphp
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                        <div class="d-flex align-items-center">
                            <img src="{{ $image }}" alt="project image"
                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="text-md mb-0 fw-medium">{{ $project->title ?? '' }}</h6>
                                <span class="text-sm text-secondary-light fw-medium">{{ $project->category?->name ?? '' }}</span>
                            </div>
                        </div>
                        <span class="text-primary-light text-md fw-medium">${{ $project->budget ?? '' }}</span>
                    </div>
                @empty
                    <p class="text-center text-secondary-light">{{ __('messages.no_projects_found') }}</p>
                @endforelse
            </div>

        </div>
    </div>
</div>
