@props(['gastro'])

@php
    $locale = app()->getLocale();
    $rawCuisines = $gastro->cuisine_types ?? [];

    $cuisinesList = $rawCuisines[$locale]
        ?? $rawCuisines['fr']
        ?? (is_array($rawCuisines) ? array_values($rawCuisines)[0] : [])
        ?? [];

    if (!is_array($cuisinesList)) {
        $cuisinesList = [];
    }
@endphp

<div class="flex items-center gap-3 text-xs font-medium text-zinc-600 dark:text-zinc-400">
    @if(count($cuisinesList) > 0)
        <span class="truncate max-w-[120px]" title="{{ implode(', ', $cuisinesList) }}">
            {{ $cuisinesList[0] }}
            @if(count($cuisinesList) > 1)
                <span class="text-zinc-400">+{{ count($cuisinesList) - 1 }}</span>
            @endif
        </span>
    @endif

    @if($gastro->michelin_stars > 0)
        <div class="flex items-center gap-1 text-red-600 font-bold" title="{{ $gastro->michelin_stars }} Étoiles Michelin">
            <flux:icon.sparkles variant="solid" class="size-3.5" />
            <span>{{ $gastro->michelin_stars }}</span>
        </div>
    @endif
</div>
