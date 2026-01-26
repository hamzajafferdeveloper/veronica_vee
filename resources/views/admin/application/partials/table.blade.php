<table class="table bordered-table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('ui.full_name') ?? 'Full Name' }}</th>
            <th>{{ __('ui.email') ?? 'Email' }}</th>
            <th>{{ __('ui.phone') ?? 'Phone' }}</th>
            <th>{{ __('ui.gender') ?? 'Gender' }}</th>
            <th>{{ __('ui.dob') ?? 'Date of Birth' }}</th>
            <th>{{ __('ui.registered_on') ?? 'Applied On' }}</th>
            <th>{{ __('ui.action') ?? 'Action' }}</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($applications as $application)
            <tr>
                <td>{{ $loop->iteration + ($applications->currentPage() - 1) * $applications->perPage() }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-md mb-0 fw-medium">{{ $application->full_name ?? '-' }}</h6>
                            <span class="text-sm text-secondary-light fw-medium">
                                {{ $application->user?->first_name ?? '-' }} {{ $application->user?->last_name ?? '-' }}
                            </span>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="text-sm">{{ $application->email ?? '-' }}</span>
                </td>
                <td>
                    <span class="text-sm">{{ $application->phone ?? '-' }}</span>
                </td>
                <td>
                    <span class="badge bg-info">{{ $application->gender ?? '-' }}</span>
                </td>
                <td>{{ $application->dob ? \Carbon\Carbon::parse($application->dob)->format('Y-m-d') : '-' }}</td>
                <td>{{ $application->created_at?->format('Y-m-d H:i') ?? '-' }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.applications.show', $application->id) }}" class="btn btn-sm bg-primary text-white">
                            <iconify-icon icon="basil:eye-outline" class="h-10-px w-10-px"></iconify-icon>
                        </a>
                        <form method="POST" action="{{ route('admin.applications.destroy', $application->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-danger text-white" onclick="return confirm('Are you sure?')">
                                <iconify-icon icon="basil:trash-outline" class="h-10-px w-10-px"></iconify-icon>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center py-4">
                    <span class="text-secondary-light">{{ __('messages.no_applications_found') ?? 'No applications found' }}</span>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3">
    {{ $applications->links() }}
</div>
