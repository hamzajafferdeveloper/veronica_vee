<div class="row g-4">
    @forelse($projects as $project)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0 rounded-4 overflow-hidden">
                {{--  --}}
                @if ($project->image && file_exists(storage_path('app/public/' . $project->image)))
                    <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="{{ $project->title }}"
                        style="height:200px; object-fit:cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height:200px;">
                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate" title="{{ $project->title }}">{{ $project->title }}</h5>

                    <p class="mb-1">
                        <i class="bi bi-currency-dollar me-1"></i>
                        <strong>Budget:</strong> ${{ number_format($project->budget, 2) }}
                    </p>
                    <p class="mb-1">
                        <i class="bi bi-tags me-1"></i>
                        <strong>Category:</strong> {{ $project->category->name ?? '-' }}
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-calendar-event me-1"></i>
                        <strong>Deadline:</strong> {{ \Carbon\Carbon::parse($project->deadline)->format('d M, Y') }}
                    </p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        {{-- Status Badge --}}
                        @if ($project->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($project->status == 'in_progress')
                            <span class="badge bg-primary">In Progress</span>
                        @elseif($project->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @endif

                        {{-- Optional: View button --}}
                        <a href="{{ route('professional.project.show', $project->slug) }}"
                            class="btn btn-sm btn-outline-primary">
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-folder-x text-muted" style="font-size:3rem;"></i>
            <p class="mt-3 text-muted">No projects found.</p>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="mt-4 d-flex justify-content-center">
    {{ $projects->links() }}
</div>
