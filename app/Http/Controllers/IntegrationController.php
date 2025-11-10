<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Integration;
use App\Models\IntegrationActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\LaravelPdf\Facades\Pdf;

class IntegrationController extends Controller
{

    public function index(Request $request)
    {
        $integrations = Integration::with(['resume', 'post', 'responsible', 'interview', 'activities']);

        if ($request->filled('status')) {
            $integrations->where('status', $request->status);
        }

        $integrations = $integrations->latest()->paginate(15);

        return response()->json($integrations);
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
            'activities.*.activity_id' => ['required', 'exists:activities,id'],
            'activities.*.date' => ['nullable', 'date'],
            'activities.*.user_id' => ['nullable', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();


        $integration = Integration::create($data);


        if (!empty($data['activities'])) {
            $pivotData = [];
            foreach ($data['activities'] as $activity) {
                $pivotData[$activity['activity_id']] = [
                    'date' => $activity['date'] ?? null,
                    'user_id' => $activity['user_id'] ?? null,
                ];
            }

            $integration->activities()->syncWithoutDetaching($pivotData);
        }

        return response()->json([
            'success' => true,
            'message' => 'Integration created successfully.',
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview', 'activities']),
        ], 201);
    }


    public function show(Integration $integration)
    {
        return response()->json($integration->load(['resume', 'post', 'responsible', 'interview', 'activities']));
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
            'activities.*.activity_id' => ['required', 'exists:activities,id'],
            'activities.*.date' => ['nullable', 'date'],
            'activities.*.user_id' => ['nullable', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();


        $integration->update($data);

        if (!empty($data['activities'])) {
            $pivotData = [];
            foreach ($data['activities'] as $activity) {
                $pivotData[$activity['activity_id']] = [
                    'date' => $activity['date'] ?? null,
                    'user_id' => $activity['user_id'] ?? null,
                ];
            }


            $integration->activities()->syncWithoutDetaching($pivotData);
        }

        return response()->json([
            'success' => true,
            'message' => 'Integration updated successfully.',
            'data' => $integration->load(['resume', 'post', 'responsible', 'interview', 'activities']),
        ]);
    }



    public function destroy(Integration $integration)
    {

        if(auth()->user()->hasRole('admin') || auth()->id() == $integration->responsible_id){
            IntegrationActivity::where('integration_id', $integration->id)->delete();
            $integration->delete();
            return response()->json(['message' => 'Besoin supprimé avec succès']);
        }

        return response()->json(['message' => 'Non autorisé'], 403);
    }

    public function download(Integration $integration)
    {
        $integration->load(['resume', 'post', 'responsible', 'activities']);

        $allActivities = Activity::all();

        return Pdf::view('integration.pdf', [
            'integration' => $integration,
            'allActivities' => $allActivities,
        ])
            ->format('a4')
            ->name('grille-evaluation.pdf');
    }
}
