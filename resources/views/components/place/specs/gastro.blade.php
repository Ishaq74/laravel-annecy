@props(['gastro'])

@php
    // 1. On récupère la locale actuelle (fr, en...)
    $locale = app()->getLocale();
    $rawCuisines = $gastro->cuisine_types ?? [];

    // 2. On essaie de trouver la liste pour cette langue
    // Si pas trouvé, on fallback sur le Français, sinon le premier dispo
    $cuisinesList = $rawCuisines[$locale] 
        ?? $rawCuisines['fr'] 
        ?? (is_array($rawCuisines) ? array_values($rawCuisines)[0] : [])
        ?? [];

    // Sécurité : on s'assure que c'est bien un tableau plat
    if (!is_array($cuisinesList)) {
        $cuisinesList = [];
    }
@endphp

<div class="flex items-center gap-3 text-xs font-medium text-zinc-600 dark:text-zinc-400">
    
    <!-- Types de Cuisine (Affichage intelligent) -->
    @if(count($cuisinesList) > 0)
        <span class="truncate max-w-[120px]" title="{{ implode(', ', $cuisinesList) }}">
            {{ $cuisinesList[0] }}
            @if(count($cuisinesList) > 1) 
                <span class="text-zinc-400">+{{ count($cuisinesList) - 1 }}</span> 
            @endif
        </span>
    @endif

    <!-- Étoiles Michelin -->
    @if($gastro->michelin_stars > 0)
        <div class="flex items-center gap-1 text-red-600 font-bold" title="{{ $gastro->michelin_stars }} Étoiles Michelin">
            <flux:icon.sparkles variant="solid" class="size-3.5" />
            <span>{{ $gastro->michelin_stars }}</span>
        </div>
    @endif
</div>