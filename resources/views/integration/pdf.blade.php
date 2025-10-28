<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plan d’Intégration des Nouvelles Recrues</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page { margin: 40px; }
        body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; }
        .border-table td, .border-table th { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body class="p-6">

    <!-- Header -->
    <div class="flex justify-between items-start mb-4">
        <div>
            <img src="{{ public_path('imgs/intercocina-logo.png') }}" alt="Logo" class="w-28 mb-2">
            <h1 class="text-lg font-semibold text-red-700 uppercase">Plan d’Intégration des Nouvelles Recrues</h1>
        </div>
        <div class="text-sm">
            <p><strong>Date :</strong> {{ $integration->hire_date ?? '................' }}</p>
            <p><strong>Code :</strong> {{ $integration->code ?? '................' }}</p>
            <p><strong>Version :</strong> V1.0</p>
        </div>
    </div>

    <!-- Employee Info -->
    <table class="w-full border-table border-collapse mb-6">
        <tr>
            <th class="text-left bg-gray-100 w-1/3">Nom et prénom</th>
            <td>{{ $integration->resume->full_name ?? '' }}</td>
        </tr>
        <tr>
            <th class="text-left bg-gray-100">Poste</th>
            <td>{{ $integration->post->name ?? '' }}</td>
        </tr>
        <tr>
            <th class="text-left bg-gray-100">Date de recrutement</th>
            <td>{{ $integration->hire_date ? \Carbon\Carbon::parse($integration->hire_date)->format('d/m/Y') : '' }}</td>
        </tr>
        <tr>
            <th class="text-left bg-gray-100">Date prévue d’évaluation</th>
            <td>{{ $integration->evaluation_date ? \Carbon\Carbon::parse($integration->evaluation_date)->format('d/m/Y') : '' }}</td>
        </tr>
    </table>

    <!-- Activities Table -->
    <table class="w-full border-table border-collapse mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="text-left w-3/4">Activité</th>
                <th class="text-left w-1/4">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allActivities as $activity)
                @php
                    // Check if this activity exists in integration->activities
                    $pivot = $integration->activities->firstWhere('id', $activity->id)?->pivot;
                @endphp
                <tr>
                    <td>{{ $activity->name }}</td>
                    <td>
                        {{ $pivot?->date
                            ? \Carbon\Carbon::parse($pivot->date)->format('d/m/Y')
                            : '' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mentor Info -->
    <table class="w-full border-table border-collapse mb-6">
        <tr>
            <th class="bg-gray-100 text-left">Parrain / Mentor :</th>
            <td>{{ $integration->responsible->full_name ?? '' }}</td>
        </tr>
        <tr>
            <th class="bg-gray-100 text-left">Période :</th>
            <td>{{ $integration->period ? $integration->period . ' Mois' : '' }}</td>
        </tr>
    </table>

    <!-- File Transfer -->
    <table class="w-full border-table border-collapse">
        <tr>
            <th class="bg-gray-100 text-left w-1/2">Passation des dossiers de travail</th>
            <td></td>
        </tr>
        <tr>
            <th class="bg-gray-100 text-left">De la part :</th>
            <td></td>
        </tr>
    </table>

</body>
</html>
