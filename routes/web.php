<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// GROUPE DE LOCALISATION (Gère /fr, /en, /ar...)
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    // --- ZONE PUBLIQUE ---

    // Page d'accueil
    Route::view('/', 'welcome')->name('home');

    // Moteur de Recherche
    Route::livewire('/explore', 'livewire.pages.explore.index')->name('explore.index');

    // Fiche Détail d'un Lieu

    Route::livewire('/place/{type}/{slug}', 'livewire.pages.places.show')->name('places.show');


    // --- ZONE CONNECTÉE (DASHBOARD) ---

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    // --- ZONE PARAMÈTRES UTILISATEUR ---
    Route::middleware(['auth'])->group(function () {
        Route::redirect('settings', 'settings/profile');

        Route::livewire('settings/profile', 'livewire.settings.profile')->name('profile.edit');
        Route::livewire('settings/password', 'livewire.settings.password')->name('user-password.edit');
        Route::livewire('settings/appearance', 'livewire.settings.appearance')->name('appearance.edit');

        Route::livewire('settings/two-factor', 'livewire.settings.two-factor')
            ->middleware(
                when(
                    Features::canManageTwoFactorAuthentication()
                        && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                    ['password.confirm'],
                    [],
                ),
            )
            ->name('two-factor.show');
    });
});