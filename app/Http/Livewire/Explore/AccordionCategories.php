<?php

namespace App\Http\Livewire\Explore;

use Livewire\Component;
use App\Services\CategoryService;

class AccordionCategories extends Component
{
    public $filterCategories = [];
    public $checked = [];
    public $open = [];

    public $categoryService;

    public function mount(CategoryService $categoryService, $type = 'place'): void
    {
        $this->categoryService = $categoryService;

        $rawTree = $this->categoryService->getCategoriesTree($type);
        $this->filterCategories = $this->transformNodes($rawTree);

        $this->checked = [];
        $this->open = [];
    }

    public function transformNodes(mixed $nodes): array
    {
        $out = [];

        if ($nodes instanceof \Illuminate\Support\Collection) {
            $nodes = $nodes->all();
        }

        if (!is_iterable($nodes)) {
            return $out;
        }

        foreach ($nodes as $node) {
            $id = null;
            $name = null;
            $children = [];

            if (is_array($node)) {
                $id = isset($node['id']) ? (string) $node['id'] : null;
                $name = $node['name'] ?? ($node['title'] ?? null);
                $children = $node['children'] ?? [];
            } elseif (is_object($node)) {
                if (isset($node->id)) $id = (string) $node->id;
                if (isset($node->name)) $name = $node->name;
                if (isset($node->title)) $name = $name ?? $node->title;
                if (isset($node->children)) $children = $node->children;
                if (method_exists($node, 'toArray') && empty($name) && empty($children)) {
                    $arr = $node->toArray();
                    $id = $id ?? (isset($arr['id']) ? (string) $arr['id'] : null);
                    $name = $name ?? ($arr['name'] ?? ($arr['title'] ?? null));
                    $children = $arr['children'] ?? [];
                }
            }

            $out[] = [
                'id' => $id ?? '',
                'name' => is_array($name) ? (string) (reset($name) ?? '') : (string) ($name ?? ''),
                'children' => $this->transformNodes($children),
            ];
        }

        return $out;
    }

    public function toggleAccordion(string $id): void
    {
        $this->open[$id] = !$this->open[$id] ?? true;
    }

    public function toggleCategorySimple(string $id): void
    {
        $checked = $this->checked[$id] ?? false;

        if ($checked) {
            $parentId = $this->findParentId($id);
            $this->open[$parentId ?? $id] = true;
        }

        $this->dispatchBrowserEvent('explore-category-toggled', [
            'id' => $id,
            'checked' => $checked
        ]);
    }

    public function findParentId(string $id): ?string
    {
        $finder = function ($nodes) use (&$finder, $id) {
            foreach ($nodes as $node) {
                if (!empty($node['children'])) {
                    foreach ($node['children'] as $child) {
                        if ($child['id'] === $id) return $node['id'];
                    }
                    $res = $finder($node['children']);
                    if ($res) return $res;
                }
            }

            return null;
        };

        return $finder($this->filterCategories);
    }

    public function resetFilters(): void
    {
        $this->checked = [];
        $this->open = [];
        $this->dispatchBrowserEvent('explore-reset-filters');
        $this->dispatchBrowserEvent('explore-reset-search');
    }

    public function render()
    {
        return view('components.explore.⚡accordion-categories.accordion-categories');
    }
}
