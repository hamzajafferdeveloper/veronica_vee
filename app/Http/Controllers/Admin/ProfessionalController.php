<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelProfiles;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function index(Request $request)
    {
        $query = ModelProfiles::query()
            ->with('user');

        // Search
        if ($request->search) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Profile fields
                $q->where('age', 'like', "%{$search}%")
                    ->orWhere('height', 'like', "%{$search}%")
                    ->orWhere('weight', 'like', "%{$search}%")

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
        $professionals = $query->paginate($per_page)->appends($request->query());

        // AJAX request returns only table HTML
        if ($request->ajax()) {
            $html = view('admin.professional.partials.table', compact('professionals'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.professional.index', compact('professionals'));
    }
}
