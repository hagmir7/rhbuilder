<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class IntegrationController extends Controller
{
    /**
     * Display a listing of the integrations.
     */
    public function index()
    {
        $integrations = Integration::with(['resume', 'post', 'responsible', 'interview'])
            ->latest()
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $integrations,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resume_id' => ['required', 'exists:resumes,id'],
            'post_id' => ['nullable', 'exists:posts,id'],
            'evaluation_date' => ['nullable', 'date'],
            'hire_date' => ['nullable', 'date'],
            'responsible_id' => ['nullable', 'exists:users,id'],
            'period' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'integer'],
            'interview_id' => ['nullable', 'exists:interviews,id'],
            'activities' => ['array'],

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        $integration = Integration::create($data);

        // Attach activities with date in pivot
        if (!empty($data['activities'])) {
            $syncData = [];
            foreach ($data['activities'] as $activity) {
                $syncData[$activity['id']] = ['date' => $activity['date'] ?? null];
            }
            $integration->activities()->sync($syncData);
        }

        return response()->json([
            'success' => true,
            'message' => 'Integration created successfully.',
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview', 'activities']),
        ], 201);
    }

    public function show(Integration $integration)
    {
        return response()->json([
            'success' => true,
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview', 'activities']),
        ]);
    }

    public function update(Request $request, Integration $integration)
    {
        $validator = Validator::make($request->all(), [
            'resume_id' => ['sometimes', 'exists:resumes,id'],
            'post_id' => ['nullable', 'exists:posts,id'],
            'evaluation_date' => ['nullable', 'date'],
            'hire_date' => ['nullable', 'date'],
            'responsible_id' => ['nullable', 'exists:users,id'],
            'period' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', 'integer'],
            'interview_id' => ['nullable', 'exists:interviews,id'],
            'activities' => ['array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        

        $data = $validator->validated();

        $integration->update($data);

        if (isset($data['activities'])) {
            foreach ($data['activities'] as $activity) {
                $integration->activities()->syncWithoutDetaching([
                    $activity['activity_id'] => ['date' => $activity['date']],
                ]);
            }
        }


        return response()->json([
            'success' => true,
            'message' => 'Integration updated successfully.',
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview', 'activities']),
        ]);
    }



    /**
     * Remove the specified integration.
     */
    public function destroy(Integration $integration)
    {
        $integration->delete();

        return response()->json([
            'success' => true,
            'message' => 'Integration deleted successfully.',
        ]);
    }
}
