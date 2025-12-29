<x-layouts.public>
    <div class="flex flex-col mx-auto gap-6 max-w-lg w-full">
        <x-auth-header
            :title="__('auth-ui.Confirm password')"
            :description="__('auth-ui.This is a secure area of the application. Please confirm your password before continuing.')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="password"
                :label="__('auth-ui.Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('auth-ui.Password')"
                viewable
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="confirm-password-button">
                {{ __('auth-ui.Confirm') }}
            </flux:button>
        </form>
    </div>
</x-layouts.public>