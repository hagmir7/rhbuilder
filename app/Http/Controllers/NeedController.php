<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Need;
use App\Models\NeedResume;
use App\Models\Resume;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelPdf\Facades\Pdf;

class NeedController extends Controller
{
    // GET /api/needs
   public function index(Request $request)
    {
        $needs = Need::with(['service', 'responsible', 'levels', 'skills']);

        if (intval($request->status) > 0) {
            $needs->where("status", intval($request->status));
        }

        $needs = $needs->latest()->get(); // assign the result

        return response()->json($needs);
    }


    // POST /api/needs
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id'     => 'required|exists:services,id',
            'responsible_id' => 'required|exists:users,id',
            'levels'     => 'nullable|array',
            'experience_min' => 'required|integer|min:0',
            'gender'         => 'nullable|integer',
            'min_age'        => 'required|integer|min:0',
            'max_age'        => 'required|integer|gte:min_age',
            'description'    => 'nullable|string',
            'skills'         => 'nullable|array',
            'skills.*'       => 'exists:skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $need = Need::create($request->only([
            'service_id',
            'responsible_id',
            'level_id',
            'experience_min',
            'gender',
            'min_age',
            'max_age',
            'status',
            'description'
        ]));

        if ($request->has('skills')) {
            $need->skills()->attach($request->skills);
        }

        if ($request->has('levels')) {
            $need->levels()->attach($request->levels);
        }

        $this->generateList($need->id);

        return response()->json($need->load(['service', 'responsible', 'levels', 'skills']), 201);
    }

    // GET /api/needs/{id}
    public function show($id)
    {
        $need = Need::with(['service', 'responsible', 'levels', 'skills'])->find($id);

        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        return response()->json($need);
    }

    // PUT/PATCH /api/needs/{id}
    public function update(Request $request, $id)
    {
        $need = Need::find($id);

        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'service_id'     => 'sometimes|exists:services,id',
            'responsible_id' => 'sometimes|exists:users,id',
            'diplome_id'     => 'sometimes|exists:diplomas,id',
            'experience_min' => 'sometimes|integer|min:0',
            'gender'         => 'sometimes|in:male,female,other',
            'min_age'        => 'sometimes|integer|min:0',
            'max_age'        => 'sometimes|integer|gte:min_age',
            'status'         => 'sometimes|boolean',
            'description'    => 'nullable|string',
            'skills'         => 'nullable|array',
            'skills.*'       => 'exists:skills,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $need->update($request->only([
            'service_id',
            'responsible_id',
            'diplome_id',
            'experience_min',
            'gender',
            'min_age',
            'max_age',
            'status',
            'description'
        ]));

        if ($request->has('skills')) {
            $need->skills()->sync($request->skills);
        }

        return response()->json($need->load(['service', 'responsible', 'level', 'skills']));
    }

    // DELETE /api/needs/{id}
    public function destroy($id)
    {
        $need = Need::find($id);

        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        $need->skills()->detach();
        $need->delete();

        return response()->json(['message' => 'Need deleted successfully']);
    }


    function getAgeInMonths($birthDate)
    {
        $birth = Carbon::parse($birthDate);
        $now = Carbon::now();
        $months = $birth->diffInMonths($now);
        return $months;
    }


    public function generateList($need_id)
    {
        // Load need with relationships in one query
        $need = Need::with(['levels', 'skills', 'resumes'])->findOrFail($need_id);

        // Get required IDs upfront
        $requiredLevelIds = $need->levels->pluck('id')->toArray();
        $requiredSkillIds = $need->skills->pluck('id')->toArray();

        // Build the query step by step
        $query = Resume::with(['levels']);


        // Apply level filter only if levels are required
        if (!empty($requiredLevelIds)) {
            $query->whereHas('levels', function ($q) use ($requiredLevelIds) {
                $q->whereIn('levels.id', $requiredLevelIds);
            });
        }

        // \Log::alert($query->get());

        // Apply skill filter only if skills are required
        if (!empty($requiredSkillIds)) {
            $query->whereHas('skills', function ($q) use ($requiredSkillIds) {
                $q->whereIn('skills.id', $requiredSkillIds);
            });
        }

        // Apply gender filter
        if (!empty($need->gender)) {
            $query->where('gender', $need->gender);
        }

        // Apply age range filter
        if ($need->min_age && $need->max_age) {
            $maxBirthDate = Carbon::now()->subYears($need->min_age)->toDateString();
            $minBirthDate = Carbon::now()->subYears($need->max_age)->toDateString();

            $query->whereBetween('birth_date', [$minBirthDate, $maxBirthDate]);
        }

        // Apply experience filter
        if ($need->experience_min) {
            $query->where('experience_month', '>=', $need->experience_min);
        }

        // Execute query
        $matchingResumes = $query->get();

        // Efficiently attach only new resumes to avoid duplicates
        if ($matchingResumes->isNotEmpty()) {
            $existingResumeIds = $need->resumes->pluck('id')->toArray();
            $newResumeIds = $matchingResumes->pluck('id')->diff($existingResumeIds)->toArray();

            if (!empty($newResumeIds)) {
                $need->resumes()->attach($newResumeIds);
            }
        }

        return $matchingResumes;
    }


    public function resumes(Need $need)
    {
        $need->load([
            'service',
            'responsible',
            'levels',
            'skills',
            'resumes' => function ($query) {
                $query->orderBy('order');
            },
            'resumes.levels',
            'resumes.city',
            'resumes.invitations'
        ]);

        $need->resumes->transform(function ($resume) {
            if ($resume->levels->isNotEmpty()) {
                $resume->top_level = $resume->levels->sortByDesc('coefficient')->first();
            } else {
                $resume->top_level = null;
            }
            unset($resume->levels);

            return $resume;
        });

        return response()->json($need);
    }

    public function updateStatus(Need $need, Request $request)
    {
        $validator = validator()->make($request->all(), [
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ]);
        }

        $need->update([
            "status" => $request->status
        ]);
    }

    public function updateOrder(Request $request, $needId)
    {
        $validated = $request->validate([
            'order' => 'required|array',
            'order.*.resume_id' => 'required|integer|exists:resumes,id',
            'order.*.order' => 'required|integer|min:1', // changed from position
        ]);

        $need = Need::findOrFail($needId);

        DB::transaction(function () use ($need, $validated) {
            foreach ($validated['order'] as $item) {
                $need->resumes()->updateExistingPivot(
                    $item['resume_id'],
                    ['order' => $item['order']] // updated column
                );
            }
        });

        return response()->json(['message' => 'Ordre mis à jour avec succès']);
    }

    public function deleteResume(NeedResume $need_resume){
        $need_resume->delete();
        return response()->json(['message', 'CV supprimé avec succès']);
    }



    public function createNeedInvitation(Request $request)
    {
        \Log::alert("ًWorking");
        dd("");
        $validator = Validator::make($request->all(), [
            'resume_id' => 'required|exists:resumes,id',
            'need_id' => 'required|exists:needs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the invitation
        $invitation = Invitation::create([
            'resume_id' => $request->resume_id,
        ]);


        // Update or create NeedResume link
        NeedResume::updateOrCreate(
            [
                'resume_id' => $request->resume_id,
                'need_id'   => $request->need_id,
            ],
            [
                'invitation_id' => $invitation->id,
            ]
        );

        return response()->json($invitation, 201);
    }

    public function createNeedBulkInvitation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'resume_ids' => 'required|array',
            'resume_ids.*' => 'exists:resumes,id',
            'need_id' => 'required|exists:needs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $needId = $request->need_id;
        $createdInvitations = [];

        foreach ($request->resume_ids as $resumeId) {

            $invitation = Invitation::create([
                'resume_id' => $resumeId,
            ]);

            NeedResume::updateOrCreate(
                [
                    'resume_id' => $resumeId,
                    'need_id'   => $needId,

                ],
                [
                    'invitation_id' => $invitation->id,
                ]
            );

            $createdInvitations[] = $invitation;
        }

        return response()->json([
            'message' => 'Invitations created successfully.',
            'data' => $createdInvitations
        ], 201);
    }




    public function download(Need $need)
    {

        return Pdf::view('need.pdf', [
            'need' => $need
        ])->format('a4')->name('grille-evaluation.pdf');
    }


    public function overview()
    {
        $overview = [
            'pending' => Need::where('status', 1)->count(),
            'in_progress' => Need::where('status', 2)->count(),
            'cancelled' => Need::where('status', 3)->count(),
            'executed' => Need::where('status', 4)->count(),
        ];

        return response()->json($overview);
    }
}
