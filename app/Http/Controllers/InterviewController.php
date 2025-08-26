<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'responsible.post:id,name'
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
    public function show(Interview $interview)
    {
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
                'errors' => $validator->errors()
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
}