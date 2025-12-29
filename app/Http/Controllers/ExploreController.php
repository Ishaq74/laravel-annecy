<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService
    ) {}

    public function index(Request $request)
    {
        $locale = app()->getLocale();

        /**
         * Catégories (arbre complet, actives, typées)
         * type = places (à adapter si besoin)
         */
        $categoriesTree = $this->categoryService->getCategoriesTree('places');
        // Flat list for select dropdown
        $categories = $categoriesTree->flatten();

        /**
         * Query Places
         */
        $placesQuery = Place::query()
            ->where('status', 'published') // or 'active' if that's your convention
            ->with([
                'category',
                'media',
            ]);

        /**
         * Recherche textuelle (PostgreSQL JSONB)
         */
        if ($request->filled('q')) {
            $placesQuery->whereRaw(
                "name->>? ILIKE ?",
                [$locale, '%' . $request->string('q')->toString() . '%']
            );
        }

        /**
         * Filtrage par catégorie (inclut les enfants)
         */
        if ($request->filled('category')) {
            $category = $categoriesTree
                ->flatten()
                ->firstWhere('id', $request->category);

            if ($category) {
                $categoryIds = $category
                    ->descendantsAndSelf()
                    ->pluck('id');

                $placesQuery->whereIn('category_id', $categoryIds);
            }
        }

        /**
         * Filtrage par note minimale
         */
        if ($request->filled('min_rating')) {
            $placesQuery->where(
                'rating',
                '>=',
                (float) $request->min_rating
            );
        }

        /**
         * Pagination finale
         */
        $places = $placesQuery
            ->orderByDesc('order_priority')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->withQueryString();

        return view('pages.explore.index', [
            'places' => $places,
            'categoriesTree' => $categoriesTree,
            'categories' => $categories,
            'filters' => [
                'q' => $request->q,
                'category' => $request->category,
                'min_rating' => $request->min_rating,
            ],
        ]);
    }
}
