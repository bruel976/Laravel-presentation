<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Tâches</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col items-center justify-center bg-gray-50 px-6 text-gray-900 antialiased">

    <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-md">
        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4.5 12.75l6 6 9-13.5" />
        </svg>
    </span>

    <h1 class="mt-6 text-center text-3xl font-semibold tracking-tight sm:text-4xl">
        Mes Tâches
    </h1>

    <p class="mt-3 max-w-md text-center text-gray-500">
        Un gestionnaire de tâches simple, construit de A à Z avec Laravel.
    </p>

    <a href="{{ route('tasks.index') }}"
       class="mt-8 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
        Ouvrir l'application
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M13.5 4.5L21 12l-7.5 7.5M21 12H3" />
        </svg>
    </a>

</body>
</html>
