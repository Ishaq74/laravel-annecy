
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen m-0 p-0 bg-white dark:bg-zinc-800 antialiased grid" style="grid-template-rows: auto 1fr auto; grid-template-areas: 'header' 'main' 'footer';">

        @include('partials.header.index')


    <!-- Main content (single <main> ensures correct semantics) -->
    <main role="main" style="grid-area: main;" class="w-full p-4 md:p-8">
        {{ $slot }}
    </main>

        @include('partials.footer')

    @fluxScripts
</body>
</html>