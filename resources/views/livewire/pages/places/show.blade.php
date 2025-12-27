<?php
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Place;

new 
#[Layout('components.layouts.public')] 
class extends Component {
    public Place $place;

    public function mount($type, $slug)
    {
        // On cherche le lieu par son slug (dans la langue actuelle)
        $this->place = Place::whereJsonContains('slug->' . app()->getLocale(), $slug)->firstOrFail();
    }
}; ?>

    <div class="container mx-auto py-10">
        <h1 class="text-4xl font-bold">{{ $place->name }}</h1>
        <p class="mt-4">{{ $place->description }}</p>
        <div class="mt-4 p-4 bg-zinc-100 rounded">
            PAGE DÉTAIL EN CONSTRUCTION (SPRINT SUIVANT)
        </div>
    </div>