<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\SkillType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillTypeController extends Controller
{
    public function index()
    {
        return SkillType::withCount('skills')->get();
    }



    public function show($id)
    {
        return SkillType::with('skills')->withCount('skills')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $skillType = SkillType::create($validator->validated());

        return response()->json($skillType, 201);
    }


    // Update a skill type
    public function update(Request $request, $id)
    {
        $skillType = SkillType::find($id);

        if (!$skillType) {
            return response()->json(['message' => 'Skill Type not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $skillType->update($validator->validated());

        return response()->json($skillType, 200);
    }

    // Delete a skill type
    public function destroy($id)
    {
        $skillType = SkillType::find($id);

        if (!$skillType) {
            return response()->json(['message' => 'Skill Type not found'], 404);
        }

        $skillType->delete();

        return response()->json(['message' => 'Skill Type deleted successfully'], 200);
    }
}
