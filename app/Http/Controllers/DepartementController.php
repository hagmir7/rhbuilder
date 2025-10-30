<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    // Display a listing of departements
    public function index()
    {
        $departements = Departement::select('id', 'name', 'logo')
            ->withCount('services')
            ->get();

        return response()->json($departements, 200);
    }

    // Store a newly created departement in storage
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string', // or 'image' if you plan to upload
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $departement = Departement::create($validator->validated());

        return response()->json($departement, 201);
    }

    // Display the specified departement
    public function show($id)
    {
        $departement = Departement::with(['services' => function ($query) {
            $query->withCount('posts');
        }])->find($id);

        if (!$departement) {
            return response()->json(['message' => 'Departement not found'], 404);
        }

        return response()->json($departement, 200);
    }

    // Update the specified departement
    public function update(Request $request, $id)
    {
        $departement = Departement::find($id);

        if (!$departement) {
            return response()->json(['message' => 'Departement not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'logo' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $departement->update($validator->validated());

        return response()->json($departement, 200);
    }

    // Remove the specified departement from storage
    public function destroy($id)
    {
        $departement = Departement::find($id);

        if (!$departement) {
            return response()->json(['message' => 'Departement not found'], 404);
        }

        $departement->delete();

        return response()->json(['message' => 'Departement deleted successfully'], 200);
    }
}
