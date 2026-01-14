<table class="table bordered-table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('ui.image') }}</th>
            <th>{{ __('ui.title') }}</th>
            <th>{{ __('ui.category') }}</th>
            <th>{{ __('ui.budget') }}</th>
            <th>{{ __('ui.deadline') }}</th>
            <th>{{ __('ui.description') }}</th>
            <th>{{ __('ui.status') }}</th>
            {{-- <th>Action</th> --}}
        </tr>
    </thead>

    <tbody>
        @forelse ($projects as $project)
            <tr>
                <td>{{ $loop->iteration + ($projects->currentPage() - 1) * $projects->perPage() }}</td>
                <td>
                    <img src="{{ asset($project->image ? 'storage/' . $project->image : 'assets/images/placeholder-1.jpg') }}"
                        alt="Project Image" class="w-60-px h-40-px rounded object-fit-cover">
                <td>{{ $project->title }}</td>
                <td>{{ $project->category->name ?? '-' }}</td>
                <td>${{ $project->budget }}</td>
                <td>{{ $project->deadline }}</td>
                <td>{{ Str::limit($project->description, 40) }}</td>
                <td> <span
                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">{{ $project->status }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('messages.no_projects_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3">
    {{ $projects->links() }}
</div>
