<?php

namespace App\Http\Controllers;

use App\Models\CriteriaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriteriaTypeController extends Controller
{
    /**
     * Display a listing of the criteria types.
     */
    public function index()
    {
        return response()->json(CriteriaType::all(), 200);
    }

    /**
     * Store a newly created criteria type in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:criteria_types,name',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $criteriaType = CriteriaType::create($validator->validated());

        return response()->json($criteriaType, 201);
    }

    /**
     * Display the specified criteria type.
     */
    public function show(CriteriaType $criteriaType)
    {
        $criteriaType->load('criteria');
        return response()->json($criteriaType, 200);
    }

    /**
     * Update the specified criteria type in storage.
     */
    public function update(Request $request, CriteriaType $criteriaType)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:criteria_types,name,' . $criteriaType->id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $criteriaType->update($validator->validated());

        return response()->json($criteriaType, 200);
    }

    /**
     * Remove the specified criteria type from storage.
     */
    public function destroy(CriteriaType $criteriaType)
    {
        $criteriaType->delete();

        return response()->json(null, 204);
    }
}
