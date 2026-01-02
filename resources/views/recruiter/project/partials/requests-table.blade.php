@if ($requests->isEmpty())
    <div class="text-center py-5 text-muted">
        <i class="bi bi-inbox fs-1"></i>
        <p class="mt-2 mb-0">No project requests yet</p>
    </div>
@else
    <div class="table-responsive">
        <table class="table align-middle table-hover border rounded-3 overflow-hidden">

            <thead class="table-light">
                <tr>
                    <th>Project</th>
                    <th>Professional</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $request->project->title }}</div>
                            <small class="text-muted">
                                Budget: ${{ number_format($request->project->budget, 2) }}
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
                                {{ ucfirst($request->status) }}
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
                                        Accept
                                    </button>
                                </form>

                                <form method="POST"
                                    action="{{ route('recruiter.project.request.reject', $request->id) }}"
                                    class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-danger rounded-pill">
                                        <i class="bi bi-x-circle"></i>
                                        Reject
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
