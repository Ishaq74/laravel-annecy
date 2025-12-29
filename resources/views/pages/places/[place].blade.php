
@php
use function Laravel\Folio\name;
name('places.show', $path ?? request()->path());
@endphp

<x-layouts.public>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Détail du lieu : {{ $place->id }}</h1>
        <!-- Ajoute ici le contenu de ta page -->
    </div>
</x-layouts.public>
