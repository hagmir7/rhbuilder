<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    // GET /api/services
    public function index()
    {
        return response()->json(Service::with(['departement', 'responsible'])->get());
    }

    // POST /api/services
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'departement_id' => 'required|exists:departements,id',
            'responsible_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $service = Service::create($request->all());

        return response()->json([
            'message' => 'Service créé avec succès.',
            'data' => $service
        ], 201);
    }

    // GET /api/services/{id}
    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service introuvable.'], 404);
        }

        return response()->json($service);
    }

    // PUT or PATCH /api/services/{id}
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service introuvable.'], 404);
        }

        dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'departement_id' => 'sometimes|required|exists:departements,id',
            'responsible_id' => 'sometimes|required|exists:users,id',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $service->update($request->all());

        return response()->json([
            'message' => 'Service mis à jour avec succès.',
            'data' => $service
        ]);
    }

    // DELETE /api/services/{id}
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service introuvable.'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service supprimé avec succès.']);
    }
}
