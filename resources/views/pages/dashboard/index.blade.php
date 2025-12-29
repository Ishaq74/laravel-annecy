@php
use function Laravel\Folio\name;
name('dashboard');
@endphp


<x-layouts.public>
    <div class="max-w-2xl mx-auto py-">
        <h1 class="text-3xl font-bold mb-6">{{ __('messages.dashboard') }}</h1>
        <p>{{ __('messages.dashboard_welcome') }}</p>
    </div>
</x-layouts.public>
