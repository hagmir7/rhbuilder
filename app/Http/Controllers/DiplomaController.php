<?php

namespace App\Http\Controllers;

use App\Models\Diploma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiplomaController extends Controller
{


public function store(Request $request)
{
    $data = $request->diplomas;
    $errors = [];

    foreach ($data as $index => $diplomaData) {
        $validator = Validator::make($diplomaData, [
            'level_id' => 'nullable|integer',
            'name' => 'required|string|max:255',
            'end_date' => 'required|date',
            'resume_id' => 'required|exists:resumes,id',
            'diplome' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            $errors[] = [
                'index' => $index,
                'errors' => $validator->errors()->all()
            ];
            continue;
        }

        // Update if level_id + resume_id exist, else create
        Diploma::updateOrCreate(
            [
                'level_id' => $diplomaData['level_id'] ?: null,
                'resume_id' => $diplomaData['resume_id'],
            ],
            [
                'name' => $diplomaData['name'],
                'end_date' => $diplomaData['end_date'],
                'diplome' => $diplomaData['diplome'] ?? null,
            ]
        );
    }

    if (!empty($errors)) {
        return response()->json([
            'message' => 'Some diplomas failed validation.',
            'errors' => $errors
        ], 422);
    }

    return response()->json(['message' => 'All diplomas saved successfully.']);
}
}
