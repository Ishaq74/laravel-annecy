<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Ville Numérique' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />

        <flux:brand href="/" logo="/build/logo.png" name="Ville Numérique" class="max-lg:hidden dark:hidden" />
        <flux:brand href="/" logo="/build/logo-dark.png" name="Ville Numérique" class="max-lg:hidden! hidden dark:flex" />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" href="{{ route('explore.index') }}" :current="request()->routeIs('explore.*')">Explorer</flux:navbar.item>
            <flux:navbar.item icon="newspaper" href="#">Magazine</flux:navbar.item>
            <flux:navbar.item icon="chat-bubble-left-ellipsis" href="#">Forum</flux:navbar.item>

            <flux:separator vertical variant="subtle" class="my-2"/>

            @php
                $currentLocale = app()->getLocale();
                $supportedLocales = LaravelLocalization::getSupportedLocales();
            @endphp
            <flux:dropdown class="max-lg:hidden">
                <flux:button variant="ghost" size="sm" class="flex items-center gap-2">
                    @switch($currentLocale)
                        @case('fr')
                            <flux:icon.fr class="mr-1" />
                            @break
                        @case('en')
                            <flux:icon.en class="mr-1" />
                            @break
                        @case('ar')
                            <flux:icon.ar class="mr-1" />
                            @break
                        @case('gb')
                            <flux:icon.gb class="mr-1" />
                            @break
                        @case('us')
                            <flux:icon.us class="mr-1" />
                            @break
                        @case('de')
                            <flux:icon.de class="mr-1" />
                            @break
                        @case('ru')
                            <flux:icon.ru class="mr-1" />
                           @break
                        @case('cn')
                            <flux:icon.cn class="mr-1" />
                            @break
                        @case('es')
                            <flux:icon.es class="mr-1" />
                            @break
                        @case('zh')
                            <flux:icon.zh class="mr-1" />
                            @break
                        @case('cn')
                            <flux:icon.cn class="mr-1" />
                            @break
                    @endswitch
                    <span class="uppercase">{{ $currentLocale }}</span>
                    <flux:icon.chevron-down class="size-4" />
                </flux:button>
                <flux:menu>
                    @foreach($supportedLocales as $localeCode => $properties)
                        @if($localeCode !== $currentLocale)
                            <flux:menu.item
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                class="flex items-center gap-2"
                            >
                                @switch($localeCode)
                                    @case('fr')
                                        <flux:icon.fr class="mr-1" />
                                        @break
                                    @case('en')
                                        <flux:icon.en class="mr-1" />
                                        @break
                                    @case('ar')
                                        <flux:icon.ar class="mr-1" />
                                        @break
                                    @case('gb')
                                        <flux:icon.gb class="mr-1" />
                                        @break
                                    @case('us')
                                        <flux:icon.us class="mr-1" />
                                        @break
                                    @case('de')
                                        <flux:icon.de class="mr-1" />
                                        @break
                                    @case('ru')
                                        <flux:icon.ru class="mr-1" />
                                        @break
                                    @case('cn')
                                        <flux:icon.cn class="mr-1" />
                                        @break
                                    @case('es')
                                        <flux:icon.es class="mr-1" />
                                        @break
                                    @case('za')
                                        <flux:icon.za class="mr-1" />
                                        @break
                                @endswitch
                                <span class="uppercase">{{ $localeCode }}</span>
                            </flux:menu.item>
                        @endif
                    @endforeach
                </flux:menu>
            </flux:dropdown>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="me-4">
            @auth
                <flux:dropdown position="top" align="start">
                    <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
                    <flux:menu>
                        <flux:menu.item href="{{ route('dashboard') }}" icon="home">Dashboard</flux:menu.item>
                        <flux:menu.separator />
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">Déconnexion</flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @else
                <flux:navbar.item icon="arrow-right-start-on-rectangle" href="{{ route('login') }}">Connexion</flux:navbar.item>
                <flux:navbar.item icon="user-plus" href="{{ route('register') }}">Inscription</flux:navbar.item>
            @endauth
        </flux:navbar>
    </flux:header>

    <!-- CONTENU PRINCIPAL -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer Simple -->
    <footer class="border-t border-zinc-200 bg-white py-8 mt-auto dark:border-zinc-800 dark:bg-zinc-900">
        <div class="container mx-auto px-4 text-center text-sm text-zinc-500">
            &copy; {{ date('Y') }} Ville Numérique. Tous droits réservés.
        </div>
    </footer>

    @fluxScripts
</body>
</html>