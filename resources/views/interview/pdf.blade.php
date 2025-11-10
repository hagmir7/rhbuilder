<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Grille d’évaluation entretien d’embauche</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            margin: 20mm 15mm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            page-break-inside: avoid !important;
        }

        tr {
            page-break-inside: avoid !important;
        }

        /* Force no splitting on page breaks for sections */
        .no-break {
            page-break-inside: avoid !important;
        }

        /* Light gray print background fix */
        .bg-gray-print {
            background-color: #f3f4f6 !important;
            -webkit-print-color-adjust: exact;
        }

        .text-xs {
            font-size: 11px;
        }

        .text-sm {
            font-size: 12px;
        }
    </style>
</head>
<body class="bg-white text-gray-800 leading-tight">

    <!-- HEADER -->
    <header class="flex justify-between items-start mb-6">
        <div>
            <img src="{{ public_path('imgs/intercocina-logo.png') }}" alt="Logo" class="h-12 mb-1">
            <h1 class="text-base font-bold text-red-700 uppercase tracking-wide">
                Grille d’évaluation entretien d’embauche
            </h1>
        </div>

        <div class="border border-gray-400 rounded p-2 text-xs leading-tight w-48">
            <p><span class="font-semibold">Date :</span> {{ $interview?->created_at ? $interview->created_at->format('d/m/Y') : '-' }}</p>
            <p><span class="font-semibold">Code :</span> IC-GDEE-OP-{{ $interview->id }}</p>
            <p><span class="font-semibold">Version :</span> V1.0</p>
        </div>
    </header>

    <!-- CANDIDATE INFO -->
    <section class="border border-gray-400 rounded p-3 mb-3 no-break">
        <h2 class="font-semibold mb-1 text-gray-700">Candidature</h2>
        <p>Nom et Prénom : <span class="font-semibold">{{ $interview?->resume?->full_name }}</span></p>
        @if ($interview?->post)
            <p>Poste souhaité : <span class="font-semibold">{{ $interview->post->name }}</span></p>
        @endif
    </section>

    <!-- JURY INFO -->
    <section class="border border-gray-400 rounded p-3 mb-3 no-break">
        <h2 class="font-semibold mb-1 text-gray-700">Jury</h2>
        <p>Nom et Prénom : <span class="font-semibold">{{ $interview?->responsible?->full_name ?? 'ACHOUKHI Assim' }}</span></p>
        @if ($interview?->responsible?->post)
            <p>Fonction : <span class="font-semibold">{{ $interview?->responsible?->post?->name }}</span></p>
        @endif
    </section>

    <!-- INTERVIEW INFO -->
    <section class="border border-gray-400 rounded p-3 mb-5 no-break">
        <div class="flex justify-between items-start">
            <div>
                <p><span class="font-semibold">Date :</span> {{ $interview?->created_at?->format('d/m/Y') ?? '-' }}</p>
                <p><span class="font-semibold">Heure :</span> {{ $interview?->created_at?->format('H:i') ?? '-' }}</p>
            </div>
            <div class="flex items-center gap-8">
                <label class="flex items-center gap-2">
                    <span>Présentielle :</span>
                    <div class="w-4 h-4 border border-gray-600 flex items-center justify-center">
                        @if($interview->type == "1") <span class="text-xs">X</span> @endif
                    </div>
                </label>
                <label class="flex items-center gap-2">
                    <span>A distance :</span>
                    <div class="w-4 h-4 border border-gray-600 flex items-center justify-center">
                        @if($interview->type == "2") <span class="text-xs">X</span> @endif
                    </div>
                </label>
            </div>
        </div>
    </section>

    <!-- EVALUATION TABLE -->
    @php
        $groupedCriteria = $interview->template->criteria->groupBy(fn($c) => $c->criteriaType->name);
    @endphp

    <table class="border border-gray-400 text-xs mb-8">
        <thead>
            <tr class="bg-gray-print border-b border-gray-400 text-center">
                <th class="p-1 border-r border-gray-400 w-1/2">Éléments d’évaluation</th>
                <th class="p-1 border-r border-gray-400">Jamais</th>
                <th class="p-1 border-r border-gray-400">Base</th>
                <th class="p-1 border-r border-gray-400">Moyen</th>
                <th class="p-1">Acquis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupedCriteria as $typeName => $criteriaGroup)
                <tr class="bg-gray-200 border-t border-gray-400 no-break">
                    <td colspan="5" class="font-semibold p-2 text-left">{{ $typeName }}</td>
                </tr>

                @foreach ($criteriaGroup as $item)
                    @php
                        $note = optional($interview->criteria->firstWhere('id', $item->id)?->pivot)->note;
                    @endphp
                    <tr class="border-t border-gray-300 no-break">
                        <td class="p-1 border-r border-gray-300">{{ $item->description }}</td>
                        <td class="border-r border-gray-300 text-center">@if($note === "1") X @endif</td>
                        <td class="border-r border-gray-300 text-center">@if($note === "2") X @endif</td>
                        <td class="border-r border-gray-300 text-center">@if($note === "3") X @endif</td>
                        <td class="text-center">@if($note === "4") X @endif</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <!-- DECISION -->
    <section class="border border-gray-400 rounded p-3 mb-8 text-xs no-break">
        <div class="flex justify-between">
            <p><span class="font-semibold">Total :</span> __________</p>
            <div class="flex gap-8">
                <label class="flex items-center gap-2">
                    <span>À retenir</span>
                    <div class="w-4 h-4 border border-gray-600 flex items-center justify-center">
                        @if($interview->decision == "2") <span class="text-xs">X</span> @endif
                    </div>
                </label>

                <label class="flex items-center gap-2">
                    <span>Liste d’attente</span>
                    <div class="w-4 h-4 border border-gray-600 flex items-center justify-center">
                        @if($interview->decision == "3") <span class="text-xs">X</span> @endif
                    </div>
                </label>

                <label class="flex items-center gap-2">
                    <span>À éliminer</span>
                    <div class="w-4 h-4 border border-gray-600 flex items-center justify-center">
                        @if($interview->decision == "4") <span class="text-xs">X</span> @endif
                    </div>
                </label>
            </div>
        </div>
    </section>

    <!-- SIGNATURE -->
    <footer class="mt-12 no-break">
        <p class="font-semibold underline mb-8">Signature du jury</p>
        <div class="border-t border-gray-400 w-48"></div>
    </footer>

</body>
</html>
