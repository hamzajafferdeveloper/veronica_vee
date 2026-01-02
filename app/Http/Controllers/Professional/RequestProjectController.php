<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use App\Models\ProjectApplication;
use Illuminate\Http\Request;

class RequestProjectController extends Controller
{
    public function request(Request $request, $projectId)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'note' => 'nullable|string|max:1000',
            ]);

            // Get the authenticated professional
            $professional = auth()->user();

            ProjectApplication::create([
                'model_id' => $professional->id,
                'project_id' => $projectId,
                'notes' => $validatedData['note'] ?? null,
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Project request sent successfully.',
            ], 200);

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error requesting project: '.$e->getMessage());

            // Redirect back with an error message
            return response()->json([
                'message' => 'An error occurred while sending the project request. Please try again later.',
            ], 500);
        }
    }
}
