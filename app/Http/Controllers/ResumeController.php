<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{
    public function index(Request $request)
    {
        $query = Resume::with('city')->withCount('invitations')->withCount('interviews');

        if ($request->filled('q') && $request->q != '') {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->q . '%')
                    ->orWhere('email', 'like', '%' . $request->q . '%')
                    ->orWhere('cin', 'like', '%' . $request->q . '%')
                    ->orWhere('address', 'like', '%' . $request->q . '%')
                    ->orWhere('phone', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->marital_status);
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('min_experience')) {
            $query->where('experience', '>=', (int) $request->min_experience);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('skills')) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->whereIn('skills.id', $request->skills);
            });
        }

        if ($request->filled('levels')) {
            $query->whereHas('levels', function ($q) use ($request) {
                $q->whereIn('levels.id', $request->input('levels'));
            });
        }

        if ($request->filled('language_id')) {
            $query->whereHas('languages', function ($q) use ($request) {
                $q->where('language_id', $request->language_id);
            });
        }


        $resumes = $query->paginate($request->input('per_page', 15));

        return response()->json($resumes);
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
            'experience_month' => 'nullable|integer',
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

    public function levels(Resume $resume)
    {
        return $resume->levels;
    }


    public function experiences(Resume $resume)
    {
        return $resume->experiences;
    }

    public function skills(Resume $resume)
    {
        return $resume->skills;
    }

    public function languages(Resume $resume)
    {
        return $resume->languages;
    }

    public function delete(Resume $resume)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->json(['message' => '401 Unauthorized'], 401);
        }

        $resume->delete();

        return response()->json(['message' => 'CV supprimé avec succès'], 200);
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
            'experience_month'  => 'nullable|integer',
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


    public function list(Request $request)
    {
        $query = Resume::select('id', 'full_name', 'phone', 'email');

        if ($request->has('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search, $request) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");

                if ($request->filled('resume_id')) {  // use filled() to check it's not empty
                    $q->orWhere("id", $request->input('resume_id'));
                }
            });
        }
        // Pagination (default 10 per page)
        $perPage = $request->input('per_page', 30);
        $resumes = $query->latest()->paginate($perPage);

        return response()->json($resumes, 200);
    }

    public function view(Resume $resume){
        $resume->load(['city', 'levels', 'languages', 'experiences', 'skills', 'workPost', 'category','languages.language']);
        return $resume;
    }


    public function interviews(Resume $resume){
        $resume->load(['interviews:id,code,responsible_id,resume_id,template_id,type,decision', 'interviews.responsible:id,full_name', 'interviews.template:id,code,name', 'city:id,name']);
        return $resume;
    }

    public function invitations(Resume $resume){
        $resume->load([
            'invitations',
            'city:id,name'
        ]);
        return $resume;
    }
}
