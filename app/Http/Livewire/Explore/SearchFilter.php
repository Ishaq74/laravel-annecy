<?php

namespace App\Http\Livewire\Explore;

use Livewire\Component;
use Illuminate\View\View;

class SearchFilter extends Component
{
    public $query = '';
    public $total = 0;

    public function mount($total = 0): void
    {
        $this->total = $total;
    }

    public function updatedQuery(): void
    {
        if (method_exists($this, 'dispatchBrowserEvent')) {
            $this->dispatchBrowserEvent('explore-search-updated', ['query' => $this->query]);
        }
    }

    public $listeners = [
        'explore:resetSearch' => 'resetSearch',
    ];

    public function resetSearch(): void
    {
        $this->query = '';
        $this->emitTo('explore.grid-places', 'explore:searchUpdated', $this->query);
    }

    public function render(): View
    {
        return view('components.explore.⚡search-filter.search-filter');
    }
}
