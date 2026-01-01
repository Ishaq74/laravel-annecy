<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Maintenance en cours') }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-zinc-50 dark:bg-zinc-900">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-amber-600 dark:text-amber-400">503</h1>
            </div>
            <h2 class="text-3xl font-semibold text-zinc-900 dark:text-white mb-4">
                {{ __('Maintenance en cours') }}
            </h2>
            <p class="text-zinc-600 dark:text-zinc-400 mb-8">
                {{ __('Le site est actuellement en maintenance. Nous serons de retour très bientôt. Merci de votre patience !') }}
            </p>
            <div class="mt-8 text-sm text-zinc-500 dark:text-zinc-500">
                <p>{{ __('Pour toute urgence, contactez-nous à :') }}</p>
                <a href="mailto:contact@salut-annecy.fr" class="text-blue-600 dark:text-blue-400 hover:underline">
                    contact@salut-annecy.fr
                </a>
            </div>
        </div>
    </div>
</body>
</html>
