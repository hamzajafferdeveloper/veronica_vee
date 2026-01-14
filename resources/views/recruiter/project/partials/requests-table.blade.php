@if ($requests->isEmpty())
    <div class="text-center py-5 text-muted">
        <i class="bi bi-inbox fs-1"></i>
        <p class="mt-2 mb-0">{{ __('messages.no_requests_yet') }}</p>
    </div>
@else
    <div class="table-responsive">
        <table class="table align-middle table-hover border rounded-3 overflow-hidden">

            <thead class="table-light">
                <tr>
                    <th>{{ __('ui.project') }}</th>
                    <th>{{ __('ui.professional') }}</th>
                    <th>{{ __('ui.note') }}</th>
                    <th>{{ __('ui.status') }}</th>
                    <th class="text-end">{{ __('ui.action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $request->project->title }}</div>
                            <small class="text-muted">
                                {{ __('ui.budget') }}: ${{ number_format($request->project->budget, 2) }}
                            </small>
                        </td>

                        <td>
                            <div class="fw-semibold">
                                {{ $request->professional->first_name }}
                                {{ $request->professional->last_name }}
                            </div>
                            <small class="text-muted">
                                {{ $request->professional->email }}
                            </small>
                        </td>

                        <td style="max-width: 260px;">
                            <div class="text-muted text-truncate" title="{{ $request->notes }}">
                                {{ $request->notes ?: '—' }}
                            </div>
                        </td>


                        <td>
                            <span
                                class="badge
                                @if ($request->status === 'pending') bg-warning text-dark
                                @elseif($request->status === 'hired') bg-success
                                @elseif($request->status === 'accepted') bg-success
                                @else bg-danger @endif">
                                {{ __("ui." . $request->status) }}
                            </span>
                        </td>

                        <td class="text-end">
                            @if ($request->status === 'pending')
                                <form method="POST"
                                    action="{{ route('recruiter.project.request.approve', $request->id) }}"
                                    class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success rounded-pill">
                                        <i class="bi bi-check-circle"></i>
                                        {{ __('buttons.accept') }}
                                    </button>
                                </form>

                                <form method="POST"
                                    action="{{ route('recruiter.project.request.reject', $request->id) }}"
                                    class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="bi bi-x-circle"></i>
                                        {{ __('buttons.reject') }}
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $requests->links() }}
    </div>

@endif
