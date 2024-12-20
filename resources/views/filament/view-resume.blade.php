<x-filament-panels::page>
    <section class="antialiased">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="min-w-[320px] bg-white text-gray-800 dark:bg-gray-950 dark:text-gray-100">   
                <div class="container mx-auto max-w-7xl">
                    <!-- Header Section -->
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-12">
                        <!-- Profile Info -->
                        <div class="relative bg-gray-100 p-6 dark:bg-gray-900 md:col-span-4 lg:p-8">
                            <!-- Profile Image -->
                            @if($record->profile_photo)
                                <div class="mb-6 flex justify-center">
                                    <img src="{{ $record->profile_photo }}" alt="{{ $record->full_name }}" class="size-32 rounded-full border-4 border-purple-200 object-cover dark:border-purple-800">
                                </div>
                            @endif
    
                            <!-- Basic Info -->
                            <h1 class="text-center text-3xl font-extrabold tracking-tight lg:text-4xl">
                                {{ $record->full_name }}
                            </h1>
                            <h2 class="mt-2 text-center text-xl font-medium text-purple-600 dark:text-purple-400">
                                {{ optional($record->experiences->last())->work_post }}
                            </h2>
    
                            <!-- Contact Information -->
                            <div class="mt-8 space-y-4">
                                @if($record->city || $record->address)
                                <div class="flex items-center gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">{{ $record->city->name }}, {{ $record->address }}</span>
                                </div>
                                @endif
    
                                @if($record->phone)
                                <div class="flex items-center gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <a href="tel:{{ $record->phone }}" class="text-sm hover:text-purple-600 dark:hover:text-purple-400">
                                        {{ $record->phone }}
                                    </a>
                                </div>
                                @endif
    
                                @if($record->email)
                                <div class="flex items-center gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <a href="mailto:{{ $record->email }}" class="text-sm hover:text-purple-600 dark:hover:text-purple-400">
                                        {{ $record->email }}
                                    </a>
                                </div>
                                @endif
                            </div>

                        
                            @if(isset($record->languages) && count($record->languages) > 0)
                            <div class="mt-8">
                                <h3 class="mb-4 text-lg font-semibold">{{ __('Langues') }}</h3>
                                <div class="space-y-2">
                                    @foreach($record->languages as $language)
                                    <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3 dark:bg-gray-800">
                                        <span class="font-medium">{{ $language->language->name }}</span>
                                        <span class="rounded-full bg-purple-100 px-3 py-1 text-sm font-medium text-purple-600 dark:bg-purple-900/50 dark:text-purple-400">
                                            {{ $language->level->getLabel() }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
    
                            <!-- Social Links -->
                            @if(isset($record->social_links) && count($record->social_links) > 0)
                            <div class="mt-8 flex justify-center space-x-4">
                                @foreach($record->social_links as $platform => $url)
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-purple-600 dark:text-gray-400 dark:hover:text-purple-400">
                                    <i class="fab fa-{{ strtolower($platform) }} text-xl"></i>
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
    
                        <!-- Main Content -->
                        <div class="space-y-12 md:col-span-8 py-5">
                            <!-- Professional Summary -->
                            @if($record->summary)
                            <div>
                                <h3 class="mb-4 border-b-2 border-purple-200 pb-2 text-2xl font-semibold dark:border-purple-800">
                                    {{ __('Résumé professionnel') }}
                                </h3>
                                <p class="text-gray-700 dark:text-gray-300">
                                    {{ $record->summary }}
                                </p>
                            </div>
                            @endif
    
                            <!-- Experience -->
                            @if($record->experiences && $record->experiences->count() > 0)
                            <div>
                                <h3 class="mb-4 border-b-2 border-purple-200 pb-2 text-2xl font-semibold dark:border-purple-800">
                                    {{ __('Expérience professionnelle') }} ({{ $record->getExperience()}}) {{ __("Mois") }}
                                </h3>
                                <div class="space-y-6">
                                    @foreach($record->experiences as $experience)
                                    <div class="relative border-l-2 border-purple-200 pl-4 dark:border-purple-800">
                                        <div class="absolute -left-1.5 top-1.5 size-3 rounded-full bg-purple-600"></div>
                                        <h4 class="text-lg font-semibold">
                                            {{ $experience->work_post }} - {{ $experience->company }}
                                        </h4>
                                        <p class="text-sm text-purple-600 dark:text-purple-400">
                                            {{ $experience->start_date }} - {{ $experience->end_date ?: __('Present') }}
                                        </p>
                                        @if($experience->description)
                                        <p class="mt-2 text-gray-700 dark:text-gray-300">
                                            {{ $experience->description }}
                                        </p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
    
                            <!-- Education -->
                            @if($record->diplomas && $record->diplomas->count() > 0)
                            <div>
                                <h3 class="mb-4 border-b-2 border-purple-200 pb-2 text-2xl font-semibold dark:border-purple-800">
                                    {{ __('Éducation') }}
                                </h3>
                                <div class="space-y-6">
                                    @foreach($record->diplomas as $diploma)
                                    <div class="relative border-l-2 border-purple-200 pl-4 dark:border-purple-800">
                                        <div class="absolute -left-1.5 top-1.5 size-3 rounded-full bg-purple-600"></div>
                                        <h4 class="text-lg font-semibold">
                                            {{ $diploma->level->name }} - {{ $diploma->name }}
                                        </h4>
                                        <p class="text-sm text-purple-600 dark:text-purple-400">
                                            {{ $diploma->end_date }}
                                        </p>
                                        @if($diploma->description)
                                        <p class="mt-2 text-gray-700 dark:text-gray-300">
                                            {{ $diploma->description }}
                                        </p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
    
                            <!-- Skills -->
                            @if(isset($record->skills) && count($record->skills) > 0)
                            <div>
                                <h3 class="mb-4 border-b-2 border-purple-200 pb-2 text-2xl font-semibold dark:border-purple-800">
                                    {{ __('Compétences') }}
                                </h3>
                                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                                    @foreach($record->skills as $skill)
                                    <div class="flex items-center gap-2">
                                        <svg class="size-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span>{{ $skill->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-filament-panels::page>