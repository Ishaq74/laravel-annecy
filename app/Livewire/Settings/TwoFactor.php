<?php

namespace App\Livewire\Settings;

use Livewire\Component;

class TwoFactor extends Component
{
    public bool $twoFactorEnabled;
    public bool $requiresConfirmation;
    public string $qrCodeSvg = '';
    public string $manualSetupKey = '';
    public bool $showModal = false;
    public bool $showVerificationStep = false;
    public string $code = '';

    public function mount(\Laravel\Fortify\Actions\DisableTwoFactorAuthentication $disableTwoFactorAuthentication): void
    {
        abort_unless(\Laravel\Fortify\Features::enabled(\Laravel\Fortify\Features::twoFactorAuthentication()), \Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        if (\Laravel\Fortify\Fortify::confirmsTwoFactorAuthentication() && is_null($user->two_factor_confirmed_at)) {
            $disableTwoFactorAuthentication($user);
        }
        $this->twoFactorEnabled = $user->hasEnabledTwoFactorAuthentication();
        $this->requiresConfirmation = \Laravel\Fortify\Features::optionEnabled(\Laravel\Fortify\Features::twoFactorAuthentication(), 'confirm');
    }

    public function enable(\Laravel\Fortify\Actions\EnableTwoFactorAuthentication $enableTwoFactorAuthentication): void
    {
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        $enableTwoFactorAuthentication($user);
        if (! $this->requiresConfirmation) {
            $this->twoFactorEnabled = $user->hasEnabledTwoFactorAuthentication();
        }
        $this->loadSetupData();
    }

    private function loadSetupData(): void
    {
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        try {
            $this->qrCodeSvg = $user?->twoFactorQrCodeSvg();
            $this->manualSetupKey = decrypt($user->two_factor_secret);
        } catch (\Exception) {
            $this->addError('setupData', 'Failed to fetch setup data.');
            $this->reset('qrCodeSvg', 'manualSetupKey');
        }
    }

    public function showVerificationIfNecessary(): void
    {
        if ($this->requiresConfirmation) {
            $this->showVerificationStep = true;
            $this->resetErrorBag();
            return;
        }
        $this->closeModal();
    }

    public function confirmTwoFactor(\Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication $confirmTwoFactorAuthentication): void
    {
        $this->validate();
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        $confirmTwoFactorAuthentication($user, $this->code);
        $this->closeModal();
        $this->twoFactorEnabled = true;
    }

    public function resetVerification(): void
    {
        $this->reset('code', 'showVerificationStep');
        $this->resetErrorBag();
    }

    public function disable(\Laravel\Fortify\Actions\DisableTwoFactorAuthentication $disableTwoFactorAuthentication): void
    {
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        $disableTwoFactorAuthentication($user);
        $this->twoFactorEnabled = false;
    }

    public function closeModal(): void
    {
        $this->reset(
            'code',
            'manualSetupKey',
            'qrCodeSvg',
            'showModal',
            'showVerificationStep',
        );
        $this->resetErrorBag();
        if (! $this->requiresConfirmation) {
            $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
            $this->twoFactorEnabled = $user->hasEnabledTwoFactorAuthentication();
        }
    }

    public function getModalConfigProperty(): array
    {
        if ($this->twoFactorEnabled) {
            return [
                'title' => __('Two-Factor Authentication Enabled'),
                'description' => __('Two-factor authentication is now enabled. Scan the QR code or enter the setup key in your authenticator app.'),
                'buttonText' => __('Close'),
            ];
        }
        if ($this->showVerificationStep) {
            return [
                'title' => __('Verify Authentication Code'),
                'description' => __('Enter the 6-digit code from your authenticator app.'),
                'buttonText' => __('Continue'),
            ];
        }
        return [
            'title' => __('Enable Two-Factor Authentication'),
            'description' => __('To finish enabling two-factor authentication, scan the QR code or enter the setup key in your authenticator app.'),
            'buttonText' => __('Continue'),
        ];
    }

    public function render()
    {
        return view('livewire.settings.two-factor');
    }
}
