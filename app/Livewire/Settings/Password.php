<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class Password extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', \Illuminate\Validation\Rules\Password::defaults(), 'confirmed'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        $user->password = $validated['password'];
        $user->save();

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }

    public function render()
    {
        return view('livewire.settings.password');
    }
}
