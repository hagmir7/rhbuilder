<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of templates.
     */
    public function index()
    {
        return response()->json(Template::all(), 200);
    }

    /**
     * Store a newly created template in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:templates,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'departement_id' => 'nullable|exists:departements,id',
            // 'criteria' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $template = Template::create($validator->safe()->except('criteria'));

 
        foreach ($request->input('criteria') as $crit) {
            $template->criteria()->attach($crit['value']);
        }

        return response()->json($template->load('criteria'), 201);
    }


    /**
     * Display the specified template.
     */
    public function show(Template $template)
    {
        return response()->json($template, 200);
    }

    /**
     * Update the specified template in storage.
     */
    public function update(Request $request, Template $template)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255|unique:templates,code,' . $template->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'departement_id' => 'nullable|exists:departements,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $template->update($validator->validated());

        return response()->json($template, 200);
    }

    /**
     * Remove the specified template from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return response()->json(null, 204);
    }
}