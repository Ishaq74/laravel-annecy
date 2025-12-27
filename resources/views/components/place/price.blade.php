@props(['level' => 1, 'max' => 5])

<div class="flex items-baseline text-sm font-medium" title="{{ __('Niveau de prix') }} : {{ $level }}/{{ $max }}">
    <span class="text-emerald-600 dark:text-emerald-400">
        {{ str_repeat('€', $level) }}
    </span>
    <span class="text-zinc-300 dark:text-zinc-700">
        {{ str_repeat('€', $max - $level) }}
    </span>
</div>