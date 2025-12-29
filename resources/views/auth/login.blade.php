<x-layouts.public>
    <div class="flex flex-col mx-auto gap-6 max-w-lg w-full">
        <x-auth-header :title="__('auth-ui.Log in to your account')" :description="__('auth-ui.Enter your email and password below to log in')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('auth-ui.Email address')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                :placeholder="__('auth-ui.Email address')"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('auth-ui.Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('auth-ui.Password')"
                viewable
            />

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <flux:checkbox name="remember" :label="__('auth-ui.remember me')" :checked="old('remember')" />
                @if (Route::has('password.request'))
                        <flux:link class="text-sm" :href="route('password.request')" wire:navigate>
                            {{ __('auth-ui.forgot your password?') }}
                        </flux:link>
                @endif
            </div>

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="login-button">
                    {{ __('auth-ui.Log in') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                <span>{{ __('auth-ui.Don\'t have an account?') }}</span>
                <flux:link :href="LaravelLocalization::localizeURL(route('register'))" wire:navigate>{{ __('auth-ui.Sign up') }}</flux:link>
            </div>
        @endif
    </div>
</x-layouts.public>