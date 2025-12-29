<flux:navbar class="-mb-px max-lg:hidden">
    <flux:navbar.item icon="home" href="{{ Route::has(app()->getLocale().'.explore') ? route(app()->getLocale().'.explore') : \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL(app()->getLocale(), '/explorer/') }}" :current="request()->routeIs(app()->getLocale().'.explore.*')">{{ __('messages.explore') }}</flux:navbar.item>
    <flux:navbar.item icon="newspaper" href="#">{{ __('messages.magazine') }}</flux:navbar.item>
    <flux:navbar.item icon="chat-bubble-left-ellipsis" href="#">{{ __('messages.forum') }}</flux:navbar.item>
</flux:navbar>
