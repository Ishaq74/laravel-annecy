<article {{ $attributes->merge(['class' => 'group flex flex-col overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm transition hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700']) }}>
    <?php
        use Illuminate\Support\Facades\Route as RouteFacade;
        $type = $place->category->type ?? 'place';
        $image = $place->getFirstMediaUrl('featured') ?: 'https://placehold.co/600x400/EEE/31343C?text=' . urlencode($place->name);

        // Prefer a named route when available, otherwise fall back to a localized URL using the place id
        if (RouteFacade::has('places.show')) {
            $url = route('places.show', ['place' => $place->id]);
        } elseif (RouteFacade::has(app()->getLocale() . '.places.show')) {
            $url = route(app()->getLocale() . '.places.show', ['place' => $place->id]);
        } else {
            $url = url('/' . app()->getLocale() . '/places/' . $place->id);
        }
    ?>

    <a href="{{ $url }}" class="relative aspect-[16/10] overflow-hidden bg-zinc-100 dark:bg-zinc-800 block">
        <img src="{{ $image }}" alt="{{ $place->featured_image_alt ?? $place->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">

        <div class="absolute top-3 left-3 flex gap-2">
            <span class="inline-flex items-center rounded-md bg-white/90 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-zinc-900 backdrop-blur shadow-sm dark:bg-zinc-800/80 dark:text-white">
                {{ $place->category->name }}
            </span>
        </div>
    </a>

    <div class="flex flex-1 flex-col p-4">
        <div class="mb-2">
            <div class="flex justify-between items-start">
                <h3 class="font-bold text-lg leading-tight text-zinc-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-1">
                    <a href="{{ $url }}">{{ $place->name }}</a>
                </h3>
                <x-place.rating :score="0" :count="0" />
            </div>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 flex items-center gap-1 mt-1">
                <flux:icon.map-pin variant="mini" class="size-3.5" />
                {{ $place->city_name }}
            </p>
        </div>

        <p class="mb-4 line-clamp-2 text-sm text-zinc-600 dark:text-zinc-400">
            {{ $place->short_description ?? \Illuminate\Support\Str::limit(strip_tags($place->description), 90) }}
        </p>

        <div class="mt-auto flex items-center justify-between border-t border-zinc-100 pt-3 dark:border-zinc-800">
            <div>
                @if($place->trail)
                    <x-place.specs.trail :trail="$place->trail" />
                @elseif($place->accommodation)
                    <x-place.specs.hotel :accommodation="$place->accommodation" />
                @elseif($place->gastronomy)
                    <x-place.specs.gastro :gastro="$place->gastronomy" />
                @endif
            </div>

            <div>
                @if($place->gastronomy)
                    <x-place.price :level="$place->gastronomy->price_level" />
                @endif
            </div>
        </div>
    </div>
</article>
