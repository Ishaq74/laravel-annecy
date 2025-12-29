@props(['accommodation'])

<div class="flex items-center gap-3 text-xs font-medium text-zinc-600 dark:text-zinc-400">
    @if($accommodation->star_rating)
        <div class="flex items-center gap-0.5 text-yellow-500" title="{{ $accommodation->star_rating }} étoiles">
            <span class="font-bold text-sm">{{ $accommodation->star_rating }}</span>
            <flux:icon.star variant="solid" class="size-3" />
        </div>
    @endif

    <div class="flex items-center gap-1" title="Capacité">
        <flux:icon.home class="size-4 text-zinc-400" />
        <span>{{ $accommodation->total_units }} chb.</span>
    </div>
</div>
