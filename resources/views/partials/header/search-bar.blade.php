<div class="hidden lg:flex items-center ms-4">
    <form action="#" method="GET" class="w-full max-w-md">
        <flux:input
            name="q"
            value="{{ request('q') }}"
            placeholder="{{ __('messages.Search') }}"
            class="w-full"
            aria-label="{{ __('messages.Search') }}"
        />
    </form>
</div>
