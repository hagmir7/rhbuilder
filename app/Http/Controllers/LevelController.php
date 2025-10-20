<?php

namespace App\Http\Controllers;


use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        return response()->json(Level::select('id', 'name', 'years', 'coefficient')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'years' => 'required|integer|min:1',
            'coefficient' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $level = Level::create($validator->validated());

        return response()->json($level, 201);
    }

    public function show(Level $level)
    {
        $level->load('resumes');
        return response()->json($level);
    }

    public function update(Request $request, Level $level)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'years' => 'required|integer|min:1',
            'coefficient' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $level->update($validator->validated());

        return response()->json($level);
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return response()->json(['message' => 'Level deleted successfully']);
    }


}
