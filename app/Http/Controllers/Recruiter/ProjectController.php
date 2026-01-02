<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recruiter\CreateProjectRequest;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::query()
            ->where('recruiter_id', auth()->id())
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
            return response()->json([
                'html' => view('recruiter.project.partials.table', compact('projects'))->render(),
            ]);
        }

        // Normal page load
        return view('recruiter.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProjectCategory::all();

        return view('recruiter.project.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $request)
    {
        try {
            $user = auth()->user();

            $slug = create_unique_slug($request->title, 'projects');

            // Handle project image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('projects/images', 'public');
            }

            // Handle project document upload
            $documentPath = null;
            if ($request->hasFile('document')) {
                $documentPath = $request->file('document')->store('projects/documents', 'public');
            }

            $project = Project::create([
                'recruiter_id' => $user->id,
                'title' => $request->title,
                'slug' => $slug,
                'budget' => $request->budget,
                'category_id' => $request->category_id,
                'deadline' => $request->deadline,
                'description' => $request->description,
                'image' => $imagePath,
                'document' => $documentPath,
                'status' => 'published',
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Project created successfully',
                'project' => $project,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Fail to create project: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Fail to create project',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::with('category')->where('slug', $slug)->first();

        dd($project);
        // return view('recruiter.project.edit', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {

        $categories = ProjectCategory::all();

        $project = Project::with('category')->where('slug', $slug)->first();

        return view('recruiter.project.edit', [
            'categories' => $categories,
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateProjectRequest $request, string $slug)
    {
        try {
            // Find the project by slug
            $project = Project::where('slug', $slug)->firstOrFail();

            // Fill basic fields
            $project->title = $request->input('title');
            $project->budget = $request->input('budget');
            $project->category_id = $request->input('category_id');
            $project->deadline = $request->input('deadline');
            $project->description = $request->input('description');

            // Handle project image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($project->image && Storage::exists($project->image)) {
                    Storage::delete($project->image);
                }

                $imagePath = $request->file('image')->store('projects', 'public');
                $project->image = $imagePath;
            }

            // Handle project document upload
            if ($request->hasFile('document')) {
                // Delete old document if exists
                if ($project->document && Storage::exists($project->document)) {
                    Storage::delete($project->document);
                }

                $documentPath = $request->file('document')->store('projects/documents', 'public');
                $project->document = $documentPath;
            }

            // Save changes
            $project->save();

            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully!',
                'project' => $project,
            ]);
        } catch (\Exception $e) {
            Log::error('Fail to create project: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Fail to create project',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        try {
            $project = Project::where('slug', $slug)->firstOrFail();

            // Delete image if exists
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }

            // Delete document if exists
            if ($project->document && Storage::disk('public')->exists($project->document)) {
                Storage::disk('public')->delete($project->document);
            }

            $project->delete();

            return response()->json([
                'status' => true,
                'message' => 'Project deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            Log::error('Fail to delete project: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Fail to delete project',
            ], 500);
        }
    }
}
