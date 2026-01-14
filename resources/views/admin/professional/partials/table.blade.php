<table class="table bordered-table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('ui.professional') }}</th>
            <th>{{ __('ui.age') }}</th>
            <th>{{ __('ui.gender') }}</th>
            <th>{{ __('ui.height') }}</th>
            <th>{{ __('ui.weight') }}</th>
            <th>{{ __('ui.location') }}</th>
            <th>{{ __('ui.registered_on') }}</th>
            {{-- <th>Status</th> --}}
            <th>{{ __('ui.action') }}</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($professionals as $professional)
            @php
                // Use professional->avatar if exists, otherwise fallback
                $avatar = $professional->avatar ? 'storage/' . $professional->avatar : 'assets/images/User.png';
            @endphp
            <tr>
                <td id="ordering_td" style="cursor: pointer">
                    <form class="orderingForm d-flex align-items-center gap-2">
                        @csrf
                        <div class="input-group input-group-sm" style="max-width: 50px;">
                            <input type="hidden" name="professional_id" value="{{ $professional->id }}">
                            <input type="number" name="ordering" class="orderingInput form-control text-center"
                                value="{{ $professional->ordering }}" min="1">
                        </div>

                        <button type="submit" class="orderingBtn btn btn-sm btn-primary d-none">
                            <i class="bi bi-check2-circle"></i>
                        </button>
                    </form>
                </td>

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
                <td>
                    <button data-bs-toggle="modal" class="btn bg-primary text-white"
                        data-bs-target="#editProfessionalModal">
                        <iconify-icon icon="basil:edit-outline" class="h-10-px w-10-px"></iconify-icon>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('messages.no_professionals_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3">
    {{ $professionals->links() }}
</div>
