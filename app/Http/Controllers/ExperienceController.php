<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->experiences;
        $errors = [];
        $updatedIds = [];

        if (empty($data) || !is_array($data)) {
            return response()->json(['message' => 'No valid experiences provided.'], 400);
        }

        $resumeId = $data[0]['resume_id'] ?? null;

        if (!$resumeId) {
            return response()->json(['message' => 'Missing resume_id.'], 400);
        }

        foreach ($data as $index => $experienceData) {
            $validator = Validator::make($experienceData, [
                'resume_id' => 'required|exists:resumes,id',
                'company' => 'nullable|string',
                'work_post' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
            ]);

            if ($validator->fails()) {
                $errors[] = [
                    'index' => $index,
                    'errors' => $validator->errors()->all()
                ];
                continue;
            }

            // Find or create/update based on level_id + resume_id
            $experience = Experience::updateOrCreate(
                [
                    'company' => $experienceData['company'] ?: null,
                    'resume_id' => $experienceData['resume_id'],
                ],
                [
                    'work_post' => $experienceData['work_post'],
                    'start_date' => $experienceData['start_date'],
                    'end_date' => $experienceData['end_date'],
                ]
            );

            $updatedIds[] = $experience->id;
        }

        // Delete experiences not in the updated list
        Experience::where('resume_id', $resumeId)
            ->whereNotIn('id', $updatedIds)
            ->delete();

        if (!empty($errors)) {
            return response()->json([
                'message' => 'Some experiences failed validation.',
                'errors' => $errors
            ], 422);
        }

        return response()->json(['message' => 'Experiences updated successfully.']);
    }
}
