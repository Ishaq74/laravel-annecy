<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryService
{
    /**
     * Récupère toutes les catégories actives d'un type donné, avec enfants préchargés.
     * 
     * @param string $type
     * @return Collection
     */
    public function getActiveCategories(string $type): Collection
    {
        return Category::active()
            ->ofType($type)
            ->with(['children' => fn($q) => $q->active()->orderBy('order_priority')])
            ->orderBy('order_priority')
            ->get();
    }

    /**
     * Récupère les catégories sous forme d'arbre (NestedSet)
     * Utilise _lft et _rgt pour reconstruire l’arborescence
     * 
     * @param string $type
     * @return Collection
     */
    public function getCategoriesTree(string $type): Collection
    {
        return Category::active()
            ->ofType($type)
            ->defaultOrder()
            ->with('children')
            ->get()
            ->toTree();
    }

    /**
     * Recherche rapide par nom dans la langue active
     * PostgreSQL : utilise JSONB GIN
     * SQLite : fait un simple filtre en array
     * 
     * @param string $type
     * @param string $locale
     * @param string $searchTerm
     * @return Collection
     */
    public function searchByName(string $type, string $locale, string $searchTerm): Collection
    {
        $query = Category::active()->ofType($type);

        if (config('database.default') === 'pgsql') {
            $query->whereRaw("name->>? ILIKE ?", [$locale, "%{$searchTerm}%"]);
            return $query->get();
        }

        // SQLite ou autre
        return $query->get()
            ->filter(fn($cat) => str_contains($cat->getTranslation('name', $locale), $searchTerm));
    }
}
