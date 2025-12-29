<article class="group rounded-lg overflow-hidden border border-zinc-200 bg-white shadow-sm dark:bg-zinc-900 dark:border-zinc-800">
    @php
        $locale = app()->getLocale();
        $title = $place->getTranslation('name', $locale);
        $short = $place->getTranslation('short_description', $locale) ?: $place->getTranslation('description', $locale);
        $excerpt = \Illuminate\Support\Str::limit(strip_tags($short), 140);
        $image = null;
        if (method_exists($place, 'getFirstMediaUrl')) {
            $image = $place->getFirstMediaUrl() ?: null;
        } elseif (isset($place->media) && $place->media->count()) {
            $first = $place->media->first();
            $image = $first->getUrl() ?? null;
        }

        $categoryName = $place->category ? $place->category->getTranslation('name', $locale) : null;
    @endphp

    <a href="{{ \Illuminate\Support\Facades\Route::has('places.show') ? route('places.show', $place->slug ?? $place->id) : '#' }}" class="block">
        <div class="h-44 w-full bg-zinc-100 dark:bg-zinc-800 overflow-hidden">
            @if($image)
                <img src="{{ $image }}" alt="{{ $place->featured_image_alt ?? $title }}" class="h-44 w-full object-cover group-hover:scale-105 transition-transform duration-200" />
            @else
                <div class="h-44 w-full flex items-center justify-center bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-900 dark:to-zinc-800">
                    <span class="text-zinc-400">No image</span>
                </div>
            @endif
        </div>
    </a>

    <div class="p-4">
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-center gap-2">
                @if($categoryName)
                    <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-0.5 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">{{ $categoryName }}</span>
                @endif
                @if($place->gastronomy)
                    <span class="inline-flex items-center rounded-md bg-rose-50 px-2 py-0.5 text-xs font-medium text-rose-700">Gastronomy</span>
                @endif
                @if($place->accommodation)
                    <span class="inline-flex items-center rounded-md bg-sky-50 px-2 py-0.5 text-xs font-medium text-sky-700">Accommodation</span>
                @endif
                @if($place->shop)
                    <span class="inline-flex items-center rounded-md bg-amber-50 px-2 py-0.5 text-xs font-medium text-amber-700">Shop</span>
                @endif
                @if($place->trail)
                    <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-0.5 text-xs font-medium text-emerald-700">Trail</span>
                @endif
            </div>

            <div class="text-sm text-zinc-500">
                @php
                    $score = $place->rating ?? 0;
                    $count = $place->reviews_count ?? $place->ratings_count ?? $place->rating_count ?? 0;
                @endphp

                <div class="flex items-center gap-1.5">
                    <div class="flex flex-wrap gap-1 items-center text-yellow-400 max-w-full">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($score))
                                <svg class="h-4 w-4 flex-shrink-0 text-amber-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.788 1.402 8.172L12 18.897l-7.336 3.873 1.402-8.172L.132 9.21l8.2-1.192z"/></svg>
                            @else
                                <svg class="h-4 w-4 flex-shrink-0 text-zinc-300 dark:text-zinc-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.788 1.402 8.172L12 18.897l-7.336 3.873 1.402-8.172L.132 9.21l8.2-1.192z"/></svg>
                            @endif
                        @endfor
                    </div>

                    @if($count > 0)
                        <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">({{ $count }})</span>
                    @endif
                </div>
            </div>
        </div>

        <h3 class="mt-3 text-base font-semibold leading-snug text-zinc-900 dark:text-white">
            <a href="{{ \Illuminate\Support\Facades\Route::has('places.show') ? route('places.show', $place->slug ?? $place->id) : '#' }}">{{ $title }}</a>
        </h3>

        @if($excerpt)
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $excerpt }}</p>
        @endif

        <div class="mt-3 flex items-center justify-between text-xs text-zinc-500">
            <div>
                @if($place->city_name)
                    <span>{{ $place->city_name }}</span>
                @endif
            </div>
            <div>
                @if(!empty($place->opening_hours))
                    <span class="inline-block px-2 py-0.5 rounded bg-zinc-100 dark:bg-zinc-800">Open</span>
                @endif
            </div>
        </div>
    </div>
</article>
