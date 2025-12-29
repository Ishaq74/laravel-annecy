<flux:navbar class="me-4">
    @auth
        <flux:dropdown position="top" align="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
            <flux:menu>
                <flux:menu.item href="{{ route(app()->getLocale().'.dashboard') }}" icon="home">{{ __('messages.dashboard') }}</flux:menu.item>
                <flux:menu.separator />
                <form method="POST" action="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '/logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">{{ __('messages.logout') }}</flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    @else
        <flux:navbar.item icon="arrow-right-start-on-rectangle" href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '/login') }}">{{ __('auth-ui.login') }}</flux:navbar.item>
        <flux:navbar.item icon="user-plus" href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), '/register') }}">{{ __('auth-ui.register') }}</flux:navbar.item>
    @endauth
</flux:navbar>
