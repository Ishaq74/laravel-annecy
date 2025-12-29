<?php

use function Laravel\Folio\name;

name('home');

return new class extends \Livewire\Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('pages.home.index');
    }
};
