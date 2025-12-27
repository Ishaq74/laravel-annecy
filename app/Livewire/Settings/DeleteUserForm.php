<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    public function deleteUser(\App\Livewire\Actions\Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        tap($user, $logout(...))->delete();
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.settings.delete-user-form');
    }
}
