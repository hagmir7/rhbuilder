<?php

namespace App\Http\Controllers;

use App\Enums\InvitationStatus;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Enums\InvitationTypeEnum;
use Illuminate\Validation\Rules\Enum;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::with('resume')->get();
        return response()->json($invitations);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'nullable|date',
            'resume_id' => 'required|exists:resumes,id',
            'interview_date' => 'nullable|date|after:now',
            'accepted' => 'nullable|boolean',
            'type' => ['nullable', new Enum(InvitationTypeEnum::class)],
            'status' => ['nullable', new Enum(InvitationStatus::class)],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $invitation = Invitation::create($validator->validated());

        return response()->json($invitation, 201);
    }

    public function UpdateStatus(Request $request, Invitation $invitation){
         $validator = Validator::make($request->all(), [
            'status' => ['required', new Enum(InvitationStatus::class)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $invitation->update([
            'status' => $request->status
        ]);

        return response()->json(['message' => "Statut de l’invitation modifié avec succès."]);

    }

    public function show(Invitation $invitation)
    {
        $invitation->load('resume');
        return response()->json($invitation);
    }

    public function update(Request $request, Invitation $invitation)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'nullable|date',
            'resume_id' => 'required|exists:resumes,id',
            'interview_date' => 'nullable|date|after:now',
            'accepted' => 'nullable|boolean',
            'type' => ['nullable', new Enum(InvitationTypeEnum::class)],
            'status' => ['nullable', new Enum(InvitationStatus::class)],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ], 422);
        }

        $invitation->update($validator->validated());

        return response()->json($invitation);
    }

    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return response()->json(null, 204);
    }
}
