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
        return response()->json(Template::with('departement')->withCount('criteria')->latest()->get(), 200);
    }

    /**
     * Store a newly created template in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'departement_id' => 'nullable|exists:departements,id',
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

    public function update(Request $request, Template $template)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'departement_id' => 'nullable|exists:departements,id',
          
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Update template basic fields
        $template->update($validator->safe()->except('criteria'));

        // Sync criteria (remove old ones, attach new ones)
        if ($request->has('criteria')) {
            $criteriaIds = collect($request->input('criteria'))
                ->pluck('value')   // take the value (ID) from your frontend payload
                ->toArray();

            $template->criteria()->sync($criteriaIds);
        }

        return response()->json($template->load('criteria'), 200);
    }



    /**
     * Display the specified template.
     */
  public function show(Template $template)
{
    $template->load([
        'criteria' => function ($query) {
            $query->select('criterias.id', 'criterias.description', 'criterias.criteria_type_id');
        },
        'criteria.criteriaType:id,name',
        'departement:id,name'
    ]);

    return response()->json($template, 200);
}


    /**
     * Update the specified template in storage.
     */


    /**
     * Remove the specified template from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return response()->json(null, 204);
    }
}