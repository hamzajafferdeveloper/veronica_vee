<table class="table bordered-table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('ui.project_title') }}</th>
            <th>{{ __('ui.category') }}</th>
            <th>{{ __('ui.budget') }}</th>
            <th>{{ __('ui.deadline') }}</th>
            <th>{{ __('ui.description') }}</th>
            <th>{{ __('ui.status') }}</th>
            <th>{{ __('ui.action') }}</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($projects as $project)
            <tr>
                <td>{{ $loop->iteration + ($projects->currentPage() - 1) * $projects->perPage() }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->category->name ?? '-' }}</td>
                <td>${{ $project->budget }}</td>
                <td>{{ $project->deadline }}</td>
                <td>{{ Str::limit($project->description, 40) }}</td>
                <td> <span
                        class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">{{ __("ui." . $project->status) }}</span>
                </td>
                <td>
                    <a href="javascript:void(0)"
                        class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                    </a>
                    <a href="{{ route('recruiter.project.edit', $project->slug) }}"
                        class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:edit"></iconify-icon>
                    </a>
                    <a href="javascript:void(0)"
                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center btn-delete-project"
                        data-url="{{ route('recruiter.project.destroy', $project->slug) }}" title="{{ __('buttons.delete_project') }}">
                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">{{ __('ui.no_projects_found') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
<div class="mt-3">
    {{ $projects->links() }}
</div>
