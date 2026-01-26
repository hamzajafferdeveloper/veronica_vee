<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query()
            ->with('user');

        // Search
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filtering by gender
        if ($request->gender && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // Sorting
        $sort_by = $request->get('sort_by', 'created_at');
        $sort_direction = $request->get('sort_direction', 'desc');

        $query->orderBy($sort_by, $sort_direction);

        // Pagination
        $per_page = $request->get('per_page', 10);
        $applications = $query->paginate($per_page)->appends($request->query());

        // AJAX request returns only table HTML
        if ($request->ajax()) {
            $html = view('admin.application.partials.table', compact('applications'))->render();

            return response()->json(['html' => $html]);
        }

        return view('admin.application.index', compact('applications'));
    }

    public function show($id)
    {
        $application = Application::with('user', 'assets')->findOrFail($id);

        return view('admin.application.show', compact('application'));
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application deleted successfully');
    }
}
