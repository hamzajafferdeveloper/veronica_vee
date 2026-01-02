<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\ProjectApplication;
use App\Models\ProjectHire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProjectAppicationController extends Controller
{
    public function requests(Request $request)
    {
        $query = ProjectApplication::with(['project', 'professional'])
            ->whereHas('project', function ($q) {
                $q->where('recruiter_id', auth()->id());
            });

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('project', function ($p) use ($search) {
                    $p->where('title', 'like', "%{$search}%");
                })
                    ->orWhereHas('professional', function ($u) use ($search) {
                        $u->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $requests = $query->latest()->paginate(10)->withQueryString();

        if ($request->ajax()) {
            // Return only the table for AJAX
            return view('recruiter.project.partials.requests-table', compact('requests'))->render();
        }

        // Return full page for normal request
        return view('recruiter.project.requests', compact('requests'));
    }

    public function approve($id)
    {
        $request = ProjectApplication::findOrFail($id);
        $request->update(['status' => 'accepted']);

        return back()->with('success', 'Project request accepted.');
    }

    public function reject($id)
    {
        $request = ProjectApplication::findOrFail($id);
        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Project request rejected.');
    }

    public function hire($id)
    {
        try {
            $request = ProjectApplication::findOrFail($id);
            $request->update(['status' => 'hired']);

            ProjectHire::create([
                'project_id' => $request->project_id,
                'model_id' => $request->model_id,
                'recruiter_id' => auth()->id(),
                'hire_date' => now(),
                'status' => 'active',
            ]);

            return back()->with('success', 'Professional hired for the project.');
        } catch (\Exception $e) {
            Log::error('Fail to hire professional: '.$e->getMessage());

            return back()->with('error', 'Fail to hire professional.');
        }
    }
}
