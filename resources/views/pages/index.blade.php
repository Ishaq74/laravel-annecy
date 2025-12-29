@php
use function Laravel\Folio\name;
name('home');

if (request()->is('/')) {
    $negotiator = new \Mcamara\LaravelLocalization\LanguageNegotiator(
        app('laravellocalization')->getDefaultLocale(),
        app('laravellocalization')->getSupportedLocales(),
        request()
    );
    $locale = $negotiator->negotiateLanguage();
    header('Location: /' . $locale . '/');
    exit;
}
@endphp


<x-layouts.public>
    <h1 class="text-2xl font-bold">{{ __('messages.welcome') }}</h1>
</x-layouts.public>
