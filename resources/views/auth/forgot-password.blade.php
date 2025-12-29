<x-layouts.public>
    <div class="flex flex-col mx-auto gap-6 max-w-lg w-full">
        <x-auth-header :title="__('auth-ui.Forgot password')" :description="__('auth-ui.Enter your email to receive a password reset link')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('auth-ui.Email address')"
                type="email"
                required
                autofocus
                :placeholder="__('auth-ui.Email address')"
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="email-password-reset-link-button">
                {{ __('auth-ui.Email password reset link') }}
            </flux:button>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
            <span>{{ __('auth-ui.Or, return to') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('auth-ui.log in') }}</flux:link>
        </div>
    </div>
</x-layouts.public>