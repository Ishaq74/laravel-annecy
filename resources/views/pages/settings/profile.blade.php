@php
use function Laravel\Folio\name;
name('settings.profile');
@endphp

<x-layouts.public>
    @volt
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Profil utilisateur</h1>
        <!-- Ajoute ici le contenu de la page profil -->
    </div>
    @endvolt
</x-layouts.public>
