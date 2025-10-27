<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the activities.
     */
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();
        return response()->json($activities);
    }

    /**
     * Store a newly created activity in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:activities,name',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $activity = Activity::create($validator->validated());

        return response()->json([
            'message' => 'Activité créée avec succès.',
            'data' => $activity,
        ], 201);
    }

    /**
     * Display the specified activity.
     */
    public function show(Activity $activity)
    {
        return response()->json($activity);
    }

    /**
     * Update the specified activity in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:activities,name,' . $activity->id,
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $activity->update($validator->validated());

        return response()->json([
            'message' => 'Activité mise à jour avec succès.',
            'data' => $activity,
        ]);
    }

    /**
     * Remove the specified activity from storage.
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json([
            'message' => 'Activité supprimée avec succès.',
        ]);
    }
}
