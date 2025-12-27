<?php

use Livewire\Component;
use App\Models\Place;
use Illuminate\Support\Str;

new class extends Component {
    public Place $place;

    public function with(): array
    {
        return [
            // On récupère le type depuis la catégorie parente ou l'extension
            'type' => $this->place->category->type ?? 'place',
            'url' => route('places.show', ['type' => Str::slug($this->place->category->type ?? 'place'), 'slug' => $this->place->slug]),
            // Fallback image si pas de média
            'image' => $this->place->getFirstMediaUrl('featured') ?: 'https://placehold.co/600x400/EEE/31343C?text=' . urlencode($this->place->name),
        ];
    }
}; ?>

<article class="group flex flex-col overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm transition hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700">
    
    <!-- Zone Image -->
    <a href="{{ $url }}" class="relative aspect-[16/10] overflow-hidden bg-zinc-100 dark:bg-zinc-800 block">
        <img src="{{ $image }}" 
             alt="{{ $place->featured_image_alt ?? $place->name }}" 
             class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
        
        <!-- Badge Type (Top Left) -->
        <div class="absolute top-3 left-3 flex gap-2">
            <span class="inline-flex items-center rounded-md bg-white/90 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-zinc-900 backdrop-blur shadow-sm dark:bg-black/80 dark:text-white">
                {{ $place->category->name }}
            </span>
        </div>
    </a>

    <!-- Zone Contenu -->
    <div class="flex flex-1 flex-col p-4">
        <!-- Titre & Ville -->
        <div class="mb-2">
            <div class="flex justify-between items-start">
                <h3 class="font-bold text-lg leading-tight text-zinc-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-1">
                    <a href="{{ $url }}">
                        {{ $place->name }}
                    </a>
                </h3>
                <x-place.rating score="0" count="0" />
            </div>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 flex items-center gap-1 mt-1">
                <flux:icon.map-pin variant="mini" class="size-3.5" />
                {{ $place->city_name }}
            </p>
        </div>

        <!-- Description -->
        <p class="mb-4 line-clamp-2 text-sm text-zinc-600 dark:text-zinc-400">
            {{ $place->short_description ?? Str::limit(strip_tags($place->description), 90) }}
        </p>

        <!-- Footer Technique (Spécifications) -->
        <div class="mt-auto flex items-center justify-between border-t border-zinc-100 pt-3 dark:border-zinc-800">
            
            <!-- Zone Spécifique au Métier -->
            <div>
                @if($place->trail)
                    <x-place.specs.trail :trail="$place->trail" />
                @elseif($place->accommodation)
                    <x-place.specs.hotel :accommodation="$place->accommodation" />
                @elseif($place->gastronomy)
                    <x-place.specs.gastro :gastro="$place->gastronomy" />
                @endif
            </div>

            <!-- Zone Prix -->
            <div>
                @if($place->gastronomy)
                    <x-place.price :level="$place->gastronomy->price_level" />
                @endif
            </div>
        </div>
    </div>
</article>