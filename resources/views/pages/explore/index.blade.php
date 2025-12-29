<x-layouts.public>
    <div class="min-h-screen bg-zinc-50 dark:bg-zinc-800">
        <div class="sticky top-0 z-40 border-b border-zinc-200 bg-white/80 backdrop-blur-md dark:border-zinc-800 dark:bg-zinc-900/80">
            <div class="container mx-auto px-4 py-4">
                <form id="explore-search-form" method="GET" action="{{ url()->current() }}" class="flex items-center gap-4" role="search" aria-label="{{ __('messages.search') }}">
                    <div class="relative flex-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <flux:icon name="magnifying-glass" class="h-5 w-5 text-zinc-400" />
                        </div>

                        <flux:input
                            id="explore-search-input"
                            name="q"
                            type="search"
                            :value="request('q')"
                            placeholder="{{ __('messages.search_placeholder') }}"
                            class="pl-10"
                            aria-label="{{ __('messages.search') }}"
                            autocomplete="off"
                        />
                    </div>

                    <div class="hidden sm:flex items-center gap-3 text-sm font-medium text-zinc-500">
                        @php
                            $resultsCount = isset($places) && $places instanceof \Illuminate\Pagination\LengthAwarePaginator
                                ? $places->total()
                                : (is_countable($places ?? null) ? count($places) : 0);
                        @endphp
                        <span aria-live="polite">{{ $resultsCount }} {{ __('messages.results') }}</span>
                    </div>

                    <flux:button type="submit" variant="primary" class="ml-2 px-4 py-2 text-xs font-semibold">
                        {{ __('messages.search') }}
                    </flux:button>
                </form>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <aside class="w-full lg:w-64 shrink-0" aria-labelledby="explore-filters-heading">
                    <div class="sticky top-24 space-y-6">
                        <form id="explore-filters-form" method="GET" action="{{ url()->current() }}" class="bg-white p-4 rounded-xl border border-zinc-200 shadow-sm dark:bg-zinc-900 dark:border-zinc-800">
                            <div class="flex items-center justify-between mb-4 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                                <flux:heading size="xs" class="uppercase tracking-wider text-zinc-900 dark:text-white" id="explore-filters-heading">
                                    {{ __('messages.filter_by') }}
                                </flux:heading>

                                <flux:button type="submit" variant="ghost" name="reset" value="1" class="text-xs text-zinc-500">
                                    {{ __('messages.reset') }}
                                </flux:button>
                            </div>

                            <div class="mb-4">
                                <flux:select name="category" label="{{ __('messages.filter_category') }}" :value="request('category')">
                                    <option value="">{{ __('messages.filter_all_categories') }}</option>
                                    @forelse($categories ?? [] as $cat)
                                        <option value="{{ $cat->id }}" @if(request('category') == $cat->id) selected @endif>
                                            {{ $cat->getTranslation('name', app()->getLocale()) }}
                                        </option>
                                    @empty
                                        <option disabled>{{ __('messages.no_categories') }}</option>
                                    @endforelse
                                </flux:select>
                            </div>

                            <!-- <div class="mb-4">
                                <flux:select name="min_rating" label="{{ __('messages.filter_by_notes') }}" :value="request('min_rating')">
                                    <option value="">{{ __('messages.filter_all_notes') }}</option>
                                    @for($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" @if((int)request('min_rating') === $i) selected @endif>{{ $i }}+ ★</option>
                                    @endfor
                                </flux:select>
                            </div> -->


                            <flux:button type="submit" variant="primary" class="w-full mt-2 px-4 py-2 text-xs font-semibold">
                                {{ __('messages.apply_filters') }}
                            </flux:button>
                        </form>
                    </div>
                </aside>

                <main class="flex-1" id="explore-results" aria-live="polite">
                    @if(isset($places) && count($places))
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($places as $place)
                                <div wire:key="place-{{ $place->id }}">
                                    <x-place.card :place="$place" />
                                </div>
                            @endforeach
                        </div>

                        @if($places instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="mt-6">
                                {{ $places->withQueryString()->links() }}
                            </div>
                        @endif
                    @else
                        <div class="mt-8 text-center text-zinc-500">
                            <flux:callout variant="muted">
                                {{ __('messages.no_results_found') }}
                            </flux:callout>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
</x-layouts.public>