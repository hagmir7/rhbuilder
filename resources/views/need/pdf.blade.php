<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche de Recrutement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-[12px] leading-tight text-gray-800 px-8 py-6">

    <!-- Header -->
    <div class="flex justify-between items-center border-b border-gray-400 pb-2 mb-4">
        <div>
            <img src="{{ public_path('imgs/intercocina-logo.png') }}" alt="Logo" class="w-28 mb-2">
            <h1 class="text-lg font-semibold text-red-700 uppercase">Fiche de Recrutement</h1>
        </div>

        <table class="border border-gray-400 text-md">
            <tr>
                <td class="border border-gray-400 px-2 py-1 font-semibold">Date :</td>
                <td class="px-2 py-1">{{ $need->created_at ?? '..............' }}</td>
            </tr>
            <tr>
                <td class="border border-gray-400 px-2 py-1 font-semibold">Code :</td>
                <td class="px-2 py-1">IC-FDR-{{ $need->id}}</td>
            </tr>
            <tr>
                <td class="border border-gray-400 px-2 py-1 font-semibold">Version :</td>
                <td class="px-2 py-1">V1.0</td>
            </tr>
        </table>
    </div>

    <!-- Info section -->
    <div class="mb-4 space-y-1 text-base">
        <p><span class="font-semibold ">Date :</span> {{ $need->created_at ?? '..............' }}</p>
        <p><span class="font-semibold">Département :</span> {{ $need->service?->departement?->name ?? '..............' }}</p>
        <p><span class="font-semibold">Service :</span> {{ $need->service->name ?? '..............' }}</p>
        <p><span class="font-semibold">Responsable :</span> {{ $need->responsible->full_name ?? '..............' }}</p>
    </div>

    <!-- 1. Explication de recrutement -->
    <div class="mb-4 text-base">
        <p class="font-semibold">1. Explication de recrutement :</p>
        <div class="ml-4 space-y-1 mt-1">
            <label class="flex items-center gap-2">
                <div class="w-3 h-3 border border-gray-600 flex items-center justify-center">
                    @if($need->reason == 1)
                        <span class="text-[10px]">X</span>
                    @endif
                </div>
                <span>Un départ temporaire ou définitif d’un salarié.</span>
            </label>
            <label class="flex items-center gap-2">
                <div class="w-3 h-3 border border-gray-600 flex items-center justify-center">
                    @if($need->reason == 2)
                        <span class="text-[10px]">X</span>
                    @endif
                </div>
                <span>De nouveaux objectifs de développement de l’entreprise.</span>
            </label>
            <label class="flex items-center gap-2">
                <div class="w-3 h-3 border border-gray-600 flex items-center justify-center">
                    @if($need->reason == 3)
                        <span class="text-[10px]">X</span>
                    @endif
                </div>
                <span>Une croissance forte de l’activité.</span>
            </label>
        </div>
    </div>

    <!-- 2. Profil Recherché -->
    <div class="mb-4 text-base">
        <p class="font-semibold">2. Profil Recherché :</p>
        <ul class="ml-8 list-disc">
            <li>Diplôme / formation :
                @foreach ($need->levels as $item)
                    {{ $item->name }},
                @endforeach
        
            </li>
            <li>Expérience : {{ $need->experience_min ?   $need->experience_min . " mois" : "..........." }}</li>
            <li>Genre : {{ $need->gender ?? 'Homme ou Femme' }}</li>
            <li>Tranche d’âge : {{ $need->min_age }} -> {{$need->max_age}}</li>
        </ul>
    </div>

    <!-- 3. Commentaire -->
    <div class="mb-6 text-base">
        <p class="font-semibold">3. Commentaire :</p>
        <div class="border border-gray-400 p-2 h-28 leading-snug w-full">
            {!! nl2br(e($need->description ?? '...............................................................................................................................................................................................................
            ...............................................................................................................................................................................................................
            ...............................................................................................................................................................................................................
            ...............................................................................................................................................................................................................
            ')) !!}
        </div>
        <div class="mt-10 text-base text-right">
            <p><span class="font-semibold">Signature :</span> ___________________________</p>
        </div>
    </div>

    <!-- 4. Accord -->
    <div class="text-base">
        <p class="font-semibold mb-1">4. Accord</p>
        <table class="w-full border border-gray-400 text-center">
            <thead class="bg-gray-100 border-b border-gray-400">
                <tr>
                    <th class="border-r border-gray-400 py-1">Département Production</th>
                    <th class="border-r border-gray-400 py-1">Département Administratif</th>
                    <th class="py-1">Service Ressources Humaines</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-r border-gray-400 h-10"></td>
                    <td class="border-r border-gray-400"></td>
                    <td></td>
                </tr>

                 <tr class="border-t border-gray-400 ">
                    <td class="border-r border-gray-400 h-10"></td>
                    <td class="border-r border-gray-400"></td>
                    <td></td>
                </tr>

                 <tr>
                    <td class="border-r border-gray-400 h-10"></td>
                    <td class="border-r border-gray-400"></td>
                    <td></td>
                </tr>
                
            </tbody>
        </table>
    </div>

</body>
</html>
