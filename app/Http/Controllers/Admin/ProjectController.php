<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query()
            ->with('category');

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('budget', 'like', "%{$request->search}%")
                    ->orWhere('deadline', 'like', "%{$request->search}%");
            });
        }

        // Sorting
        $sort_by = $request->get('sort_by', 'id');
        $sort_direction = $request->get('sort_direction', 'desc');

        $query->orderBy($sort_by, $sort_direction);

        // Pagination
        $per_page = $request->get('per_page', 10);
        $projects = $query->paginate($per_page)->appends($request->query());

        // AJAX request returns only table HTML
        if ($request->ajax()) {
            $html = view('admin.projects.partials.table', compact('projects'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.projects.index', compact('projects'));
    }
}
