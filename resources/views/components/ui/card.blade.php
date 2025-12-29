@props(['class' => ''])

<div {{ $attributes->merge(['class' => trim('bg-white rounded-lg shadow-sm overflow-hidden dark:bg-zinc-900 '.$class)]) }}>
    @if(isset($header))
        <div class="p-4 border-b border-zinc-100 dark:border-zinc-800">
            {{ $header }}
        </div>
    @endif

    @if(isset($media))
        <div class="w-full">
            {{ $media }}
        </div>
    @endif

    <div class="p-4">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="p-4 border-t border-zinc-100 dark:border-zinc-800">
            {{ $footer }}
        </div>
    @endif
</div>
