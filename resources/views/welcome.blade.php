<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RH Builder - INTERCOCINA</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <img src="/imgs/intercocina-logo.png" alt="Intercocina" class="h-12 w-auto text-white lg:h-28">
                        </div>
                    </header>
                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <div class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="w-full">
                                   @livewire('login-form')
                                </div>
                            </div>

                            <a href="#!"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-6 shrink-0 self-center text-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="currentColor"><path d="M5.75 7.5A2.25 2.25 0 0 1 9.5 5.823a.75.75 0 0 0 1-1.118a3.75 3.75 0 1 0-5 5.59a.75.75 0 0 0 1-1.118A2.24 2.24 0 0 1 5.75 7.5M16 3.75a3.74 3.74 0 0 0-2.5.955a.75.75 0 0 0 1 1.118a2.25 2.25 0 0 1 3 3.355a.75.75 0 0 0 1 1.117A3.75 3.75 0 0 0 16 3.75"/><path d="M12 6.75a3.75 3.75 0 1 0 0 7.5a3.75 3.75 0 0 0 0-7.5m-5.81 7.726a.75.75 0 0 0-.38-1.452c-.97.255-1.836.682-2.474 1.256c-.64.575-1.086 1.336-1.086 2.22a.75.75 0 0 0 1.5 0c0-.346.17-.729.59-1.105c.42-.378 1.054-.71 1.85-.92m12-1.45a.75.75 0 0 0-.38 1.45c.796.21 1.43.542 1.85.92c.42.376.59.76.59 1.105a.75.75 0 0 0 1.5 0c0-.884-.446-1.645-1.086-2.22c-.638-.574-1.504-1.001-2.474-1.255M12 15.75c-1.493 0-2.881.362-3.921.986c-1.025.615-1.829 1.569-1.829 2.764a.75.75 0 0 0 1.5 0c0-.462.316-1.007 1.1-1.478c.77-.462 1.882-.772 3.15-.772s2.38.31 3.15.772c.784.47 1.1 1.017 1.1 1.478a.75.75 0 0 0 1.5 0c0-1.195-.804-2.15-1.829-2.764c-1.04-.624-2.428-.986-3.921-.986"/></g></svg>
                                </div>

                                <div class="pt-3 sm:pt-3">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Gestion de CVs</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Vous pouvez accéder facilement aux données des employés, les mettre à jour et les classer rapidement, ce qui facilite le processus de recrutement et la prise de décisions administratives avec plus d'efficacité et de précision.
                                    </p>
                                </div>
                            </a>

                            <a href="#!" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-6 shrink-0 self-center text-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 9.429V5a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v8.286m6-3.857V21m0-11.571h4a2 2 0 0 1 2 2V19a2 2 0 0 1-2 2h-4m0 0H9m0 0v-7.714M9 21H5a2 2 0 0 1-2-2v-3.714a2 2 0 0 1 2-2h4"/></svg>

                                </div>

                                <div class="pt-3 sm:pt-3">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Evaluation</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Gestion des ressources humaines vous aide à optimiser la gestion des CV des employés, à économiser du temps et des efforts, tout en vous permettant de sélectionner les candidats les plus compétents avec une efficacité accrue.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        App v0.5.0
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
