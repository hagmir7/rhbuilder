<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\ResumeLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LanguageController extends Controller
{
    public function index()
    {
        return response()->json(Language::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $language = Language::create($validator->validated());

        return response()->json($language, 201);
    }

    public function show(Language $language)
    {
        return response()->json($language);
    }

    public function update(Request $request, Language $language)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $language->update($validator->validated());

        return response()->json($language);
    }

    public function destroy(Language $language)
    {
        $language->delete();

        return response()->json(['message' => 'Language deleted successfully']);
    }


    public function resumeLanagueStore(Request $request)
    {
        $data = $request->languages;
        $errors = [];
        $updatedIds = [];

        if (empty($data) || !is_array($data)) {
            return response()->json(['message' => 'Aucune compétence valide fournie.'], 400);
        }

        $resumeId = $data[0]['resume_id'] ?? null;

        if (!$resumeId) {
            return response()->json(['message' => 'Identifiant de CV manquant.'], 400);
        }

        foreach ($data as $index => $languageData) {
            $validator = Validator::make($languageData, [
                'resume_id' => 'required|exists:resumes,id',
                'language_id' => 'required|exists:languages,id',
                'level' => 'required|integer'
            ]);

            if ($validator->fails()) {
                $errors[] = [
                    'index' => $index,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()->all()
                ];
                continue;
            }

            $langauge = ResumeLanguage::updateOrCreate(
                [
                    'resume_id' => $languageData['resume_id'],
                    'language_id' => $languageData['language_id'],

                ],
                ['level' => $languageData['level']]
            );

            $updatedIds[] = $langauge->id;
        }

        ResumeLanguage::where('resume_id', $resumeId)
            ->whereNotIn('id', $updatedIds)
            ->delete();

        if (!empty($errors)) {
            return response()->json([
                'message' => 'Certaines langauges n’ont pas été enregistrées.',
                'errors' => $errors
            ], 422);
        }

        return response()->json(['message' => 'Les langauges ont été mises à jour avec succès.']);
    }
}
