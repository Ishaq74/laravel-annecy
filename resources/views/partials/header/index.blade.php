<flux:header
    style="grid-area: header;"
    container
    class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700"
>
    {{-- Toggle sidebar / menu mobile --}}
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />

    {{-- Brand --}}
    @include('partials.header.brand')

    <flux:spacer />

    {{-- Navigation desktop --}}
    <div class="hidden lg:flex">
        @include('partials.header.navigation')
    </div>

    {{-- Spacer central --}}
    <flux:spacer />

    {{-- Search (desktop only) --}}
    <div class="hidden lg:flex">
        @include('partials.header.search-bar')
    </div>
    
    <flux:spacer />

    {{-- Lang switcher --}}
    <div class="hidden lg:flex">
        @include('partials.header.lang-switcher')
    </div>

    {{-- User section --}}
    @include('partials.header.user-section')

    {{-- Theme switcher --}}
    @include('partials.header.theme-switcher')
</flux:header>
