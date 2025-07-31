<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    // GET /api/departements
    public function index()
    {
        return response()->json(Departement::withCount('services')->get());
    }

    // POST /api/departements
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $departement = Departement::create($request->all());

        return response()->json([
            'message' => 'Département créé avec succès.',
            'data' => $departement
        ], 201);
    }

    // GET /api/departements/{id}
    public function show($id)
    {
        $departement = Departement::with('services')->find($id);

        if (!$departement) {
            return response()->json(['message' => 'Département introuvable.'], 404);
        }

        return response()->json($departement);
    }

    // PUT or PATCH /api/departements/{id}
    public function update(Request $request, $id)
    {
        $departement = Departement::find($id);

        if (!$departement) {
            return response()->json(['message' => 'Département introuvable.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $departement->update($request->all());

        return response()->json([
            'message' => 'Département mis à jour avec succès.',
            'data' => $departement
        ]);
    }

    // DELETE /api/departements/{id}
    public function destroy($id)
    {
        $departement = Departement::find($id);

        if (!$departement) {
            return response()->json(['message' => 'Département introuvable.'], 404);
        }

        $departement->delete();

        return response()->json(['message' => 'Département supprimé avec succès.']);
    }
}
