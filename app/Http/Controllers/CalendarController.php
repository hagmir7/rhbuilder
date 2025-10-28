<?php

namespace App\Http\Controllers;


use App\Models\Invitation;
use App\Models\Integration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function calendar(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        if (!$month || !$year) {
            return response()->json(['error' => 'Month and year are required.'], 422);
        }

        // --- Invitations ---
        $invitations = Invitation::with('resume')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get(['id', 'resume_id', 'date']);

        // --- Integrations ---
        $integrations = Integration::with('resume')
            ->where(function ($query) use ($month, $year) {
                $query->whereMonth('evaluation_date', $month)
                    ->whereYear('evaluation_date', $year)
                    ->orWhere(function ($q) use ($month, $year) {
                        $q->whereMonth('hire_date', $month)
                            ->whereYear('hire_date', $year);
                    });
            })
            ->get(['id', 'resume_id', 'evaluation_date', 'hire_date']);

        // --- Combine both collections ---
        $calendarData = [];

        // Invitations
        foreach ($invitations as $invitation) {
            $date = Carbon::parse($invitation->date)->format('Y-m-d');

            if (!isset($calendarData[$date])) {
                $calendarData[$date] = [];
            }

            $calendarData[$date][] = [
                'id' => $invitation->resume->id,
                'title' => optional($invitation->resume)->full_name ?? 'Invitation',
                'priority' => 'invitation',
                'completed' => false,
            ];
        }

        // Integrations
        foreach ($integrations as $integration) {
            // --- Evaluation Date Event ---
            if ($integration->evaluation_date) {
                $evalDate = Carbon::parse($integration->evaluation_date)->format('Y-m-d');

                if (!isset($calendarData[$evalDate])) {
                    $calendarData[$evalDate] = [];
                }

                $calendarData[$evalDate][] = [
                    'id' => $integration->resume->id,
                    'title' => optional($integration->resume)->full_name ?? 'Intégration',
                    'priority' => 'evaluation',
                    'completed' => false,
                ];
            }

            // --- Hire Date Event ---
            if ($integration->hire_date) {
                $hireDate = Carbon::parse($integration->hire_date)->format('Y-m-d');

                if (!isset($calendarData[$hireDate])) {
                    $calendarData[$hireDate] = [];
                }

                $calendarData[$hireDate][] = [
                    'id' => $integration->resume->id,
                    'title' => optional($integration->resume)->full_name ?? 'Intégration',
                    'priority' => 'integration',
                    'completed' => false,
                ];
            }
        }

        ksort($calendarData); // Sort by date

        return response()->json($calendarData);
    }
}
