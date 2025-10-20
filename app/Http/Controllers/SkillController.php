<?php

namespace App\Http\Controllers;

use App\Models\ResumeSkill;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::all();
    }

    public function resumeSkillStore(Request $request)
    {
        $data = $request->skills;
        $errors = [];
        $updatedIds = [];

        if (empty($data) || !is_array($data)) {
            return response()->json(['message' => 'Aucune compétence valide fournie.'], 400);
        }

        $resumeId = $data[0]['resume_id'] ?? null;

        if (!$resumeId) {
            return response()->json(['message' => 'Identifiant de CV manquant.'], 400);
        }

        foreach ($data as $index => $skillData) {
            $validator = Validator::make($skillData, [
                'resume_id' => 'required|exists:resumes,id',
                'skill_id' => 'required|exists:skills,id',
            ]);

            if ($validator->fails()) {
                $errors[] = [
                    'index' => $index,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()->all()
                ];
                continue;
            }


            $skill = ResumeSkill::updateOrCreate(
                [
                    'resume_id' => $skillData['resume_id'],
                    'skill_id' => $skillData['skill_id'],
                ],
                []
            );

            $updatedIds[] = $skill->id;
        }



        ResumeSkill::where('resume_id', $resumeId)
            ->whereNotIn('id', $updatedIds)
            ->delete();

        if (!empty($errors)) {
            return response()->json([
                'message' => 'Certaines compétences n’ont pas été enregistrées.',
                'errors' => $errors
            ], 422);
        }

        return response()->json(['message' => 'Les compétences ont été mises à jour avec succès.']);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'skill_type_id' => 'nullable|exists:skill_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $skill = Skill::create($validator->validated());

        return response()->json($skill, 201);
    }

    public function show($id)
    {
        $skill = Skill::with(['type', 'resumes'])->find($id);

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        return response()->json($skill, 200);
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'skill_type_id' => 'nullable|exists:skill_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $skill->update($validator->validated());

        return response()->json($skill, 200);
    }

    // Delete a skill
    public function destroy($id)
    {
        $skill = Skill::find($id);

        if (!$skill) {
            return response()->json(['message' => 'Skill not found'], 404);
        }

        $skill->delete();

        return response()->json(['message' => 'Skill deleted successfully'], 200);
    }
}
