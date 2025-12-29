@props(['trail'])

<div class="flex items-center gap-3 text-xs font-medium text-zinc-600 dark:text-zinc-400">
    <div class="flex items-center gap-1" title="Distance">
        <flux:icon.map class="size-4 text-zinc-400" />
        <span>{{ $trail->distance_km }} km</span>
    </div>
    
    <div class="flex items-center gap-1" title="Dénivelé Positif">
        <flux:icon.chart-bar class="size-4 text-zinc-400" />
        <span>{{ $trail->elevation_gain }}m D+</span>
    </div>

    @php
        $colors = [
            'green' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
            'blue'  => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'red'   => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
            'black' => 'bg-zinc-900 text-white dark:bg-zinc-800 dark:text-zinc-200',
        ];
        $color = $colors[$trail->difficulty] ?? $colors['green'];
    @endphp
    <span class="px-1.5 py-0.5 rounded text-[10px] uppercase tracking-wider font-bold {{ $color }}">
        {{ $trail->difficulty }}
    </span>
</div>
