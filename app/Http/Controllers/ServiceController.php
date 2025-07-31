<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    // Display a listing of the services
    public function index()
    {
        $services = Service::with(['departement'])->select('id', 'name', 'departement_id')->get();
        return response()->json($services, 200);
    }

    // Store a newly created service in storage
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'departement_id' => 'required|integer|exists:departements,id',
            'description' => 'nullable|string',
            'responsible_id' => 'nullable|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $service = Service::create($validator->validated());

        return response()->json($service, 201);
    }

    // Display the specified service
    public function show($id)
    {
        $service = Service::with(['departement', 'responsible'])->find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json($service, 200);
    }

    // Update the specified service in storage
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'departement_id' => 'sometimes|required|integer|exists:departements,id',
            'description' => 'nullable|string',
            'responsible_id' => 'nullable|integer|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $service->update($validator->validated());

        return response()->json($service, 200);
    }

    // Remove the specified service from storage
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $service->delete();
        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
