<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Erreur serveur') }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-zinc-50 dark:bg-zinc-900">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-red-600 dark:text-red-400">500</h1>
            </div>
            <h2 class="text-3xl font-semibold text-zinc-900 dark:text-white mb-4">
                {{ __('Erreur serveur') }}
            </h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-8">
                {{ __('Désolé, une erreur est survenue sur le serveur. Nos équipes ont été notifiées et travaillent à résoudre le problème.') }}
            </p>
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    {{ __('Retour à l\'accueil') }}
                </a>
                <button onclick="window.location.reload()" class="block w-full px-6 py-3 border border-zinc-300 dark:border-zinc-700 text-base font-medium rounded-md text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    {{ __('Réessayer') }}
                </button>
            </div>
        </div>
    </div>
</body>
</html>
