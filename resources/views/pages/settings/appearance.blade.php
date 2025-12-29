@php
use function Laravel\Folio\name;
name('settings.appearance');
@endphp

<x-layouts.public>
    @volt
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Apparence</h1>
        <!-- Ajoute ici le contenu de la page apparence -->
    </div>
    @endvolt
</x-layouts.public>
