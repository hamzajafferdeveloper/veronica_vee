<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecruiterProfiles;
use Illuminate\Http\Request;

class RecruiterController extends Controller
{
    public function index(Request $request)
    {
        $query = RecruiterProfiles::query()
            ->with('user');

        // Search
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Profile fields
                $q->where('address', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    // Related user fields
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        // Sorting
        $sort_by = $request->get('sort_by', 'id');
        $sort_direction = $request->get('sort_direction', 'desc');

        $query->orderBy($sort_by, $sort_direction);

        // Pagination
        $per_page = $request->get('per_page', 10);
        $recruiters = $query->paginate($per_page)->appends($request->query());

        // AJAX request returns only table HTML
        if ($request->ajax()) {
            $html = view('admin.recruiter.partials.table', compact('recruiters'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.recruiter.index', compact('recruiters'));
    }
}
