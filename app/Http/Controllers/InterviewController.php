<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelPdf\Facades\Pdf;

class InterviewController extends Controller
{
    /**
     * Display a listing of the interviews.
     */
    public function index(Request $request)
    {
        $interview = Interview::with([
            'resume:id,full_name,phone',
            'company:id,name',
            'post:id,name',
            'user:id,full_name,phone',
            'template:id,code,name',
            'responsible:id,full_name,post_id',
            'responsible.post:id,name',
            'criteria'
        ]);



        if(isset($request->status)){
            $interview->where('decision', $request->status);
        }
        
        return response()->json($interview->latest()->get(), 200);
    }

    /**
     * Store a newly created interview in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'responsible_id' => 'required|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
            'resume_id' => 'nullable|exists:resumes,id',
            'post_id' => 'nullable|exists:posts,id',
            'template_id' => 'nullable|exists:templates,id',
            'date' => 'nullable|date',
            'type' => 'required|integer',
            'company_id' => 'nullable|exists:companies,id',
            'decision' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $interview = Interview::create($validator->validated());

        return response()->json($interview, 201);
    }

    /**
     * Display the specified interview.
     */
    // public function show(Interview $interview)
    // {
    //      $interview->load('template.criteria', 'resume', 'post', 'responsible', 'criteria');
    //     return response()->json($interview, 200);
    // }

    public function show(Interview $interview)
    {
        $interview->load(
            'template.criteria:id,code,description,criteria_type_id',
            'template:id,code,name',
            'resume:id,full_name,email,phone,birth_date',
            'post',
            'responsible:id,name,full_name',
            'criteria:id,code,description',
            'template.criteria.criteriaType'
        );
        return response()->json($interview, 200);
    }

    /**
     * Update the specified interview in storage.
     */
    public function update(Request $request, Interview $interview)
    {
        $validator = Validator::make($request->all(), [
            'responsible_id' => 'required|exists:users,id',
            'user_id' => 'nullable|exists:users,id',
            'resume_id' => 'nullable|exists:resumes,id',
            'post_id' => 'nullable|exists:posts,id',
            'template_id' => 'nullable|exists:templates,id',
            'date' => 'nullable|date',
            'type' => 'required|integer',
            'company_id' => 'nullable|exists:companies,id',
            'decision' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $interview->update($validator->validated());

        return response()->json($interview, 200);
    }

    /**
     * Remove the specified interview from storage.
     */
    public function destroy(Interview $interview)
    {
        $interview->delete();

        return response()->json(null, 204);
    }

    public function updateType(Interview $interview,  Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'        => 'required|integer'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors'  => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $interview->update([
            'type' => $request->type
        ]);

        return response()->json(['message' => "Type édité avec succès", 200]);
    }

    public function updateDecision(Interview $interview,  Request $request)
    {
        $validator = Validator::make($request->all(), [
            'decision'        => 'required|integer'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errors'  => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $interview->update([
            'decision' => $request->decision
        ]);

        return response()->json(['message' => "Decision édité avec succès", 200]);
    }




    public function evaluateCriteria(Interview $interview, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'criteria_id' => 'required|integer|exists:criterias,id',
            'note'        => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'  => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        if ($interview->criteria()->where('criteria_id', $request->criteria_id)->exists()) {
            $interview->criteria()->updateExistingPivot($request->criteria_id, [
                'note' => $request->note
            ]);
        } else {
            $interview->criteria()->attach($request->criteria_id, [
                'note' => $request->note
            ]);
        }

        $interview->load('template.criteria', 'resume', 'post', 'responsible', 'criteria');

        return response()->json($interview);
    }

    public function download(Interview $interview)
    {
        $interview->load(['resume']);

        return Pdf::view('interview.pdf', [
            'interview' => $interview
        ])->format('a4')->name('grille-evaluation.pdf')->withBrowsershot(function ($browsershot) {
            $browsershot
                ->setNodeBinary('/home/admin1/.nvm/versions/node/v24.11.0/bin/node')
                ->setNpmBinary('/home/admin1/.nvm/versions/node/v24.11.0/bin/npm');
        });
    }


}