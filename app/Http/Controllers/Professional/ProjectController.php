<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['recruiter', 'category']);

        // Search filter
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'desc');
        $query->orderBy($sortBy, $sortDirection);

        // Pagination
        $perPage = $request->get('per_page', 10);
        $projects = $query->paginate($perPage)->withQueryString();

        // Check if the request is AJAX (for dynamic card loading)
        if ($request->ajax()) {
            $html = view('professional.project.partials.cards', compact('projects'))->render();
            return response()->json(['html' => $html]);
        }

        return view('professional.project.index', compact('projects'));
    }


    public function show(string $slug)
    {
        return view('professional.project.show');
    }
}
