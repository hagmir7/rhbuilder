<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    public function index()
    {
        return Resume::with(['city'])->latest()->paginate(20);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:resumes,email',
            'phone' => 'nullable|string|max:20',
            'marital_status' => 'nullable|integer',
            'birth_date' => 'nullable|date',
            'gender' => 'required|integer',
            'cin' => 'nullable|string|max:30',
            'address' => 'nullable|string',
            'city_id' => 'nullable|exists:cities,id',
            'status' => 'nullable|integer',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'user_id' => 'nullable|exists:users,id',
            'company_work_post_id' => 'nullable|exists:company_work_posts,id',
            'experience_monthe' => 'nullable|integer',
            'nationality' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()
                ],
                422
            );
        }

        $data = $request->all();

        if ($request->hasFile('cv_file')) {
            $data['cv_file'] = $request->file('cv_file')->store('cv_files', 'public');
        }

        if ($request->hasFile('cover_letter_file')) {
            $data['cover_letter_file'] = $request->file('cover_letter_file')->store('cover_letters', 'public');
        }

        $resume = Resume::create($data);

        return response()->json([
            'message' => 'Resume stored successfully.',
            'resume' => $resume
        ], 201);
    }



    public function show(Resume $resume)
    {
        return $resume;
    }

    public function diplomes(Resume $resume)
    {
        return $resume->diplomas;
    }


    public function experiences(Resume $resume)
    {
        return $resume->experiences;
    }
    

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => "nullable|email|unique:resumes,email,{$id}",
            'phone'              => 'nullable|string|max:20',
            'marital_status'     => 'nullable|integer',
            'birth_date'         => 'nullable|date',
            'gender'             => 'required|integer',
            'cin'                => 'nullable|string|max:30',
            'address'            => 'nullable|string',
            'city_id'            => 'nullable|exists:cities,id',
            'status'             => 'nullable|integer',
            'cv_file'            => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter_file'  => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'user_id'            => 'nullable|exists:users,id',
            'company_work_post_id' => 'nullable|exists:company_work_posts,id',
            'experience_monthe'  => 'nullable|integer',
            'nationality'        => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        $resume = Resume::findOrFail($id);

        $data = $validator->validated();

        if ($request->hasFile('cv_file')) {
            $data['cv_file'] = $request->file('cv_file')->store('cv_files', 'public');
        }

        if ($request->hasFile('cover_letter_file')) {
            $data['cover_letter_file'] = $request->file('cover_letter_file')->store('cover_letters', 'public');
        }

        $resume->update($data);

        return response()->json([
            'message' => 'Resume updated successfully.',
            'resume'  => $resume,
        ], 200);
    }
}
