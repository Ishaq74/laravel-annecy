@php
    $currentLocale = app()->getLocale();
    $supportedLocales = LaravelLocalization::getSupportedLocales();
@endphp
<flux:dropdown class="max-lg:hidden">
    <flux:button variant="ghost" size="sm" class="flex items-center gap-2">
        @switch($currentLocale)
            @case('fr')
                <flux:icon.fr class="mr-1" />
                @break
            @case('en')
                <flux:icon.en class="mr-1" />
                @break
            @case('ar')
                <flux:icon.ar class="mr-1" />
                @break
            @case('en')
                <flux:icon.en class="mr-1" />
                @break
            @case('us')
                <flux:icon.us class="mr-1" />
                @break
            @case('de')
                <flux:icon.de class="mr-1" />
                @break
            @case('ru')
                <flux:icon.ru class="mr-1" />
                @break
            @case('zh')
                <flux:icon.zh class="mr-1" />
                @break
            @case('es')
                <flux:icon.es class="mr-1" />
                @break
            @case('zh')
                <flux:icon.zh class="mr-1" />
                @break
            @case('zh')
                <flux:icon.zh class="mr-1" />
                @break
            @case('it')
                <flux:icon.it class="mr-1" />
                @break
            @case('pt')
                <flux:icon.pt class="mr-1" />
                @break
            @case('ru')
                <flux:icon.ru class="mr-1" />
                @break
            @case('hi')
                <flux:icon.hi class="mr-1" />
                @break
        @endswitch
        <span class="uppercase">{{ $currentLocale }}</span>
        <flux:icon.chevron-down class="size-4" />
    </flux:button>
    <flux:menu>
        @foreach($supportedLocales as $localeCode => $properties)
            @if($localeCode !== $currentLocale)
                <flux:menu.item
                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}/"
                    class="flex items-center gap-2"
                >
                    @switch($localeCode)
                        @case('fr')
                            <flux:icon.fr class="mr-1" />
                            @break
                        @case('en')
                            <flux:icon.en class="mr-1" />
                            @break
                        @case('ar')
                            <flux:icon.ar class="mr-1" />
                            @break
                        @case('en')
                            <flux:icon.en class="mr-1" />
                            @break
                        @case('us')
                            <flux:icon.us class="mr-1" />
                            @break
                        @case('de')
                            <flux:icon.de class="mr-1" />
                            @break
                        @case('ru')
                            <flux:icon.ru class="mr-1" />
                            @break
                        @case('zh')
                            <flux:icon.zh class="mr-1" />
                            @break
                        @case('es')
                            <flux:icon.es class="mr-1" />
                            @break
                        @case('it')
                            <flux:icon.it class="mr-1" />
                            @break
                        @case('pt')
                            <flux:icon.pt class="mr-1" />
                            @break
                        @case('ru')
                            <flux:icon.ru class="mr-1" />
                            @break
                        @case('hi')
                            <flux:icon.hi class="mr-1" />
                            @break
                    @endswitch
                    <span class="uppercase">{{ $localeCode }}</span>
                </flux:menu.item>
            @endif
        @endforeach
    </flux:menu>
</flux:dropdown>
