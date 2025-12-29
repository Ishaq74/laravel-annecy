<x-layouts.public>
    <div class="flex flex-col mx-auto gap-6 max-w-lg w-full">
        <x-auth-header :title="__('auth-ui.Reset password')" :description="__('auth-ui.Please enter your new password below')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Token -->
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <!-- Email Address -->
            <flux:input
                name="email"
                value="{{ request('email') }}"
                :label="__('auth-ui.Email')"
                type="email"
                required
                autocomplete="email"
            />

            <!-- Password -->
            <flux:input
                name="password"
                :label="__('auth-ui.Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('auth-ui.Password')"
                viewable
            />

            <!-- Confirm Password -->
            <flux:input
                name="password_confirmation"
                :label="__('auth-ui.Confirm password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('auth-ui.Confirm password')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="reset-password-button">
                    {{ __('auth-ui.Reset password') }}
                </flux:button>
            </div>
        </form>
    </div>
</x-layouts.public>