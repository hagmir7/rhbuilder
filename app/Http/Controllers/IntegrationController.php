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

    /**
     * Store a newly created integration.
     */
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $integration = Integration::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Integration created successfully.',
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview']),
        ], 201);
    }

    /**
     * Display the specified integration.
     */
    public function show(Integration $integration)
    {
        return response()->json([
            'success' => true,
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview']),
        ]);
    }

    /**
     * Update the specified integration.
     */
    public function update(Request $request, Integration $integration)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['sometimes', 'string', Rule::unique('integrations')->ignore($integration->id)],
            'resume_id' => ['sometimes', 'exists:resumes,id'],
            'post_id' => ['nullable', 'exists:posts,id'],
            'evaluation_date' => ['nullable', 'date'],
            'hire_date' => ['nullable', 'date'],
            'responsible_id' => ['nullable', 'exists:users,id'],
            'period' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', 'integer'],
            'interview_id' => ['nullable', 'exists:interviews,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $integration->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Integration updated successfully.',
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview']),
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
