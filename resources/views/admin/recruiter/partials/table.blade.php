<table class="table bordered-table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Recruiter</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Registered On</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($recruiters as $recruiter)
            @php
                // Use recruiter->avatar if exists, otherwise fallback
                $avatar = $recruiter->avatar ? 'storage/' . $recruiter->avatar : 'assets/images/User.png';
            @endphp
            <tr>
                <td>{{ $loop->iteration + ($recruiters->currentPage() - 1) * $recruiters->perPage() }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($avatar) }}" alt=""
                            class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                        <div class="flex-grow-1">
                            <h6 class="text-md mb-0 fw-medium">
                                {{ $recruiter->user?->first_name ?? '-' }}
                                {{ $recruiter->user?->last_name ?? '-' }}</h6>
                            <span
                                class="text-sm text-secondary-light fw-medium">{{ $recruiter->user?->email ?? '-' }}</span>
                        </div>
                    </div>
                </td>
                <td>{{ $recruiter->phone ?? '-' }}</td>
                <td>{{ Str::limit($recruiter->address, 15) ?? '-' }}</td>
                <td>{{ $recruiter->user?->created_at?->format('Y-m-d') ?? ($recruiter->created_at?->format('Y-m-d') ?? '-') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No recruiters found</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3">
    {{ $recruiters->links() }}
</div>
