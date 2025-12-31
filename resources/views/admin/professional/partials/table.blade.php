<table class="table bordered-table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Professional</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Height</th>
            <th>Weight</th>
            <th>Location</th>
            <th>Registered On</th>
            {{-- <th>Status</th> --}}
            {{-- <th>Action</th> --}}
        </tr>
    </thead>

    <tbody>
        @forelse ($professionals as $professional)
            @php
                // Use professional->avatar if exists, otherwise fallback
                $avatar = $professional->avatar ? 'storage/' . $professional->avatar : 'assets/images/User.png';
            @endphp
            <tr>
                <td>{{ $loop->iteration + ($professionals->currentPage() - 1) * $professionals->perPage() }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($avatar) }}" alt=""
                            class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                        <div class="flex-grow-1">
                            <h6 class="text-md mb-0 fw-medium">
                                {{ $professional->user?->first_name ?? '-' }}
                                {{ $professional->user?->last_name ?? '-' }}</h6>
                            <span
                                class="text-sm text-secondary-light fw-medium">{{ $professional->user?->email ?? '-' }}</span>
                        </div>
                    </div>
                </td>
                <td>{{ $professional->age ?? '-' }}</td>
                <td>{{ $professional->gender ?? '-' }}</td>
                <td>{{ $professional->height ?? '-' }}</td>
                <td>{{ $professional->weight ?? '-' }}</td>
                <td>{{ Str::limit($professional->location, 15) ?? '-' }}</td>
                <td>{{ $professional->created_at?->format('Y-m-d') ?? '-' }}</td>
                {{-- <td>{{ Str::limit($professional->description, 40) }}</td> --}}
                {{-- <td> <span
                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">{{ $professional->status }}</span>
                </td> --}}
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No professionals found</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3">
    {{ $professionals->links() }}
</div>
