@props(['score' => 0, 'count' => 0])

<div class="flex items-center gap-1.5">
    <div class="flex text-yellow-400">
        @for($i = 1; $i <= 5; $i++)
            @if($i <= round($score))
                <flux:icon.star variant="solid" class="size-4" />
            @else
                <flux:icon.star variant="outline" class="size-4 text-zinc-300 dark:text-zinc-600" />
            @endif
        @endfor
    </div>
    @if($count > 0)
        <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">({{ $count }})</span>
    @endif
</div>