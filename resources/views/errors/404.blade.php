<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Page non trouvée') }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-zinc-50 dark:bg-zinc-900">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-blue-600 dark:text-blue-400">404</h1>
            </div>
            <h2 class="text-3xl font-semibold text-zinc-900 dark:text-white mb-4">
                {{ __('Page non trouvée') }}
            </h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-8">
                {{ __('Désolé, la page que vous recherchez n\'existe pas ou a été déplacée.') }}
            </p>
            <div class="space-y-3">
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    {{ __('Retour à l\'accueil') }}
                </a>
            </div>
        </div>
    </div>
</body>
</html>
