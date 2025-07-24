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

            // Mise à jour ou création basée sur skill_id + resume_id
            $skill = ResumeSkill::updateOrCreate(
                [
                    'resume_id' => $skillData['resume_id'],
                    'skill_id' => $skillData['skill_id'],
                ],
                [] 
            );

            $updatedIds[] = $skill->id;
        }

        // Supprimer les anciennes compétences non présentes dans la nouvelle liste
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
}
