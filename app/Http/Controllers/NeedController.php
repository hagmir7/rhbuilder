<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Need;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NeedController extends Controller
{
    // GET /api/needs
    public function index()
    {
        $needs = Need::with(['service', 'responsible', 'level', 'skills'])->latest()->get();
        return response()->json($needs);
    }

    // POST /api/needs
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id'     => 'required|exists:services,id',
            'responsable_id' => 'required|exists:users,id',
            'level_id'     => 'required|exists:levels,id',
            'experience_min' => 'required|integer|min:0',
            'gender'         => 'required|integer',
            'min_age'        => 'required|integer|min:0',
            'max_age'        => 'required|integer|gte:min_age',
            'description'    => 'nullable|string',
            'skills'         => 'nullable|array',
            'skills.*'       => 'exists:skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $need = Need::create($request->only([
            'service_id',
            'responsable_id',
            'level_id',
            'experience_min',
            'gender',
            'min_age',
            'max_age',
            'status',
            'description'
        ]));

        if ($request->has('skills')) {
            $need->skills()->attach($request->skills);
        }

        return response()->json($need->load(['service', 'responsible', 'level', 'skills']), 201);
    }

    // GET /api/needs/{id}
    public function show($id)
    {
        $need = Need::with(['service', 'responsible', 'level', 'skills'])->find($id);

        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        return response()->json($need);
    }

    // PUT/PATCH /api/needs/{id}
    public function update(Request $request, $id)
    {
        $need = Need::find($id);

        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'service_id'     => 'sometimes|exists:services,id',
            'responsable_id' => 'sometimes|exists:users,id',
            'diplome_id'     => 'sometimes|exists:diplomas,id',
            'experience_min' => 'sometimes|integer|min:0',
            'gender'         => 'sometimes|in:male,female,other',
            'min_age'        => 'sometimes|integer|min:0',
            'max_age'        => 'sometimes|integer|gte:min_age',
            'status'         => 'sometimes|boolean',
            'description'    => 'nullable|string',
            'skills'         => 'nullable|array',
            'skills.*'       => 'exists:skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $need->update($request->only([
            'service_id',
            'responsable_id',
            'diplome_id',
            'experience_min',
            'gender',
            'min_age',
            'max_age',
            'status',
            'description'
        ]));

        if ($request->has('skills')) {
            $need->skills()->sync($request->skills);
        }

        return response()->json($need->load(['service', 'responsible', 'level', 'skills']));
    }

    // DELETE /api/needs/{id}
    public function destroy($id)
    {
        $need = Need::find($id);

        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        $need->skills()->detach();
        $need->delete();

        return response()->json(['message' => 'Need deleted successfully']);
    }
}
