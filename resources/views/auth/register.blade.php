<x-layouts.public>
    <div class="flex flex-col mx-auto gap-6 max-w-lg w-full">
        <x-auth-header :title="__('auth-ui.Create an account')" :description="__('auth-ui.Enter your details below to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            
            <!-- Name (Deviendra nom_affichage) -->
            <flux:input
                name="nom_affichage"
                :label="__('auth-ui.Full name')"
                :value="old('nom_affichage')"
                type="text"
                required
                autofocus
                autocomplete="nom_affichage"
                :placeholder="__('auth-ui.Full name')"
            />

            <!-- AJOUT PRD : Username -->
            <!-- Note: Pas de wire:model ici car on est dans un form classique POST -->
            <flux:input 
                name="username"
                :label="__('auth-ui.Username (@pseudo)')"
                :value="old('username')"
                type="text"
                required
                autocomplete="username"
                :placeholder="__('auth-ui.Username (@pseudo)')"
            />

            <!-- Email Address -->
            <flux:input
                name="email"
                :label="__('auth-ui.Email address')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                :placeholder="__('auth-ui.Email address')"
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
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('auth-ui.Create account') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('auth-ui.Already have an account?') }}</span>
            <!-- Lien vers le login -->
            <flux:link :href="LaravelLocalization::localizeURL(route('login'))" wire:navigate>{{ __('auth-ui.Log in') }}</flux:link>
        </div>
    </div>
</x-layouts.public>