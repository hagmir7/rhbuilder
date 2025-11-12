<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criteria = Criteria::with('criteriaType')->get();

        return response()->json($criteria);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string|max:255',
            'criteria_type_id' => 'required|exists:criteria_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $criteria = Criteria::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Critère créé avec succès.',
            'data' => $criteria
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $criteria = Criteria::with('criteriaType')->find($id);

        if (!$criteria) {
            return response()->json([
                'success' => false,
                'message' => 'Critère non trouvé.'
            ], 404);
        }

        return response()->json($criteria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $criteria = Criteria::find($id);

        if (!$criteria) {
            return response()->json([
                'success' => false,
                'message' => 'Critère non trouvé.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string|max:255',
            'criteria_type_id' => 'sometimes|required|exists:criteria_types,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $criteria->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Critère mis à jour avec succès.',
            'data' => $criteria
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $criteria = Criteria::find($id);

        if (!$criteria) {
            return response()->json([
                'success' => false,
                'message' => 'Critère non trouvé.'
            ], 404);
        }

        $criteria->delete();

        return response()->json([
            'success' => true,
            'message' => 'Critère supprimé avec succès.'
        ]);
    }
}
