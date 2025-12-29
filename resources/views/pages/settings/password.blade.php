@php
use function Laravel\Folio\name;
name('settings.password');
@endphp

<x-layouts.public>
    @volt
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Changer le mot de passe</h1>
        <!-- Ajoute ici le contenu de la page mot de passe -->
    </div>
    @endvolt
</x-layouts.public>
