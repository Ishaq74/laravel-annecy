<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\Place;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

new 
#[Layout('components.layouts.public')] 
class extends Component {
    use WithPagination;

    #[Url(as: 'q')] 
    public string $search = ''; 
    
    #[Url(as: 'c')] 
    public array $selectedCategories = []; 

    public function updatedSearch() { $this->resetPage(); }
    
    // Quand on coche une catégorie, on reset la page pour éviter d'être en page 2 vide
    public function updatedSelectedCategories() { $this->resetPage(); }

    public function with(): array
    {
        $locale = app()->getLocale();

        // 1. Requête principale
        $query = Place::query()
            ->with(['category', 'gastronomy', 'accommodation', 'trail', 'media']) 
            ->where('status', 'published');

        // 2. Recherche Textuelle (JSONB insensible à la casse)
        if (!empty($this->search)) {
            $term = '%' . strtolower($this->search) . '%';
            $query->where(function (Builder $q) use ($locale, $term) {
                $q->whereRaw("LOWER(name->>?) LIKE ?", [$locale, $term])
                  ->orWhereRaw("LOWER(description->>?) LIKE ?", [$locale, $term])
                  ->orWhereRaw("LOWER(city_name) LIKE ?", [$term]);
            });
        }

        // 3. Filtre Catégories (Logique Nested Sets)
        if (!empty($this->selectedCategories)) {
            // On récupère les catégories sélectionnées
            $parentCats = Category::whereIn("slug->$locale", $this->selectedCategories)->get();
            
            if ($parentCats->isNotEmpty()) {
                $query->whereHas('category', function ($q) use ($parentCats) {
                    $q->where(function ($subQ) use ($parentCats) {
                        foreach ($parentCats as $parent) {
                            // On prend la catégorie ET tous ses descendants
                            $subQ->orWhereBetween('_lft', [$parent->_lft, $parent->_rgt]);
                        }
                    });
                });
            }
        }

        return [
            'places' => $query->latest()->paginate(9),
            // On charge l'arbre : Racines avec leurs enfants triés
            'filterCategories' => Category::whereIsRoot()
                ->with(['children' => fn($q) => $q->orderBy('order_priority')])
                ->orderBy('order_priority')
                ->get(),
        ];
    }

    public function resetAll() {
        $this->reset(['search', 'selectedCategories']);
    }
}; ?>

<div class="min-h-screen bg-zinc-50 dark:bg-black">
    
    <!-- HEADER DE RECHERCHE -->
    <div class="sticky top-0 z-40 border-b border-zinc-200 bg-white/80 backdrop-blur-md dark:border-zinc-800 dark:bg-zinc-900/80">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center gap-4">
                <div class="relative flex-1">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <flux:icon.magnifying-glass class="h-5 w-5 text-zinc-400" />
                    </div>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        class="block w-full rounded-lg border-zinc-200 bg-zinc-50 py-2.5 pl-10 pr-4 text-sm text-zinc-900 focus:border-indigo-500 focus:ring-indigo-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder-zinc-400"
                        placeholder="{{ __('Rechercher un lieu, une activité, une ville...') }}"
                    >
                </div>
                <div class="hidden sm:block text-sm font-medium text-zinc-500">
                    {{ $places->total() }} {{ __('résultats') }}
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENU PRINCIPAL -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- SIDEBAR FILTRES (ACCORDÉON) -->
            <aside class="w-full lg:w-64 shrink-0">
                <div class="sticky top-24 space-y-6">
                    
                    <!-- Bloc Catégories -->
                    <div class="bg-white p-4 rounded-xl border border-zinc-200 shadow-sm dark:bg-zinc-900 dark:border-zinc-800">
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-900 dark:text-white">{{ __('Filtrer par') }}</h3>
                            @if(!empty($selectedCategories))
                                <button wire:click="resetAll" class="text-xs text-indigo-600 hover:underline cursor-pointer">{{ __('Reset') }}</button>
                            @endif
                        </div>

                        <div class="space-y-1">
                            @foreach($filterCategories as $root)
                                <div x-data="{ expanded: @entangle('selectedCategories').includes('{{ $root->slug }}') }" class="group">
                                    
                                    <!-- Ligne Parent -->
                                    <div class="flex items-center justify-between py-1.5 px-2 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition">
                                        <label class="flex items-center gap-3 cursor-pointer flex-1">
                                            <input type="checkbox" 
                                                   wire:model.live="selectedCategories" 
                                                   value="{{ $root->slug }}" 
                                                   @change="if($el.checked) expanded = true"
                                                   class="rounded border-zinc-300 text-indigo-600 focus:ring-indigo-600 dark:border-zinc-700 dark:bg-zinc-800 dark:checked:bg-indigo-500">
                                            
                                            <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                                                {{ $root->name }}
                                            </span>
                                        </label>

                                        <!-- Bouton Chevron (Uniquement si enfants) -->
                                        @if($root->children->count() > 0)
                                            <button @click="expanded = !expanded" class="p-1 rounded-md text-zinc-400 hover:text-zinc-600 hover:bg-zinc-200 dark:hover:bg-zinc-700">
                                                <flux:icon.chevron-down class="size-4 transition-transform duration-200" ::class="expanded ? 'rotate-180' : ''" />
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Enfants (Accordéon) -->
                                    @if($root->children->count() > 0)
                                        <div x-show="expanded" x-collapse class="pl-8 pr-2 space-y-1 pb-2">
                                            @foreach($root->children as $child)
                                                <label class="flex items-center gap-2 cursor-pointer py-1 group/child">
                                                    <input type="checkbox" 
                                                           wire:model.live="selectedCategories" 
                                                           value="{{ $child->slug }}" 
                                                           class="rounded border-zinc-300 text-indigo-600 focus:ring-indigo-600 dark:border-zinc-700 dark:bg-zinc-800">
                                                    <span class="text-sm text-zinc-500 group-hover/child:text-zinc-900 dark:text-zinc-400 dark:group-hover/child:text-zinc-200">
                                                        {{ $child->name }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </aside>

            <!-- GRILLE RÉSULTATS -->
            <div class="flex-1">
                <!-- Loader -->
                <div wire:loading class="w-full mb-6">
                    <div class="h-1 w-full bg-indigo-100 overflow-hidden rounded-full">
                        <div class="h-full bg-indigo-500 w-1/3 animate-progress"></div>
                    </div>
                </div>

                @if($places->count() > 0)
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach($places as $place)
                            <livewire:place.card :place="$place" :key="$place->id" />
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $places->links() }}
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-zinc-200 bg-white py-20 text-center dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="rounded-full bg-zinc-100 p-4 dark:bg-zinc-800">
                            <flux:icon.magnifying-glass class="h-8 w-8 text-zinc-400" />
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">{{ __('Aucun résultat') }}</h3>
                        <p class="mt-2 max-w-sm text-sm text-zinc-500">
                            {{ __('Essayez de modifier vos filtres ou votre recherche.') }}
                        </p>
                        <button wire:click="resetAll" class="mt-6 inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-500">
                            {{ __('Tout effacer') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes progress {
            0% { margin-left: -30%; width: 30%; }
            50% { width: 60%; }
            100% { margin-left: 100%; width: 100%; }
        }
        .animate-progress {
            animation: progress 1.5s infinite ease-in-out;
        }
    </style>
</div>