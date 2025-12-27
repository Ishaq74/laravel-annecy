<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class Profile extends Component
{
    public string $nom_affichage = '';
    public string $email = '';

    public function mount(): void
    {
        $this->nom_affichage = \Illuminate\Support\Facades\Auth::user()->nom_affichage;
        $this->email = \Illuminate\Support\Facades\Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        $validated = $this->validate([
            'nom_affichage' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique(\App\Models\User::class)->ignore($user->id)
            ],
        ]);
        foreach ($validated as $key => $value) {
            $user->$key = $value;
        }
        if ($user->email !== \Illuminate\Support\Facades\Auth::user()->email) {
            $user->email_verified_at = null;
        }
        $user->save();
        $this->dispatch('profile-updated', nom_affichage: $user->nom_affichage);
    }

    public function resendVerificationNotification(): void
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && $user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }
        if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
            $user->sendEmailVerificationNotification();
        }
    }

    public function render()
    {
        return view('livewire.settings.profile');
    }
}
