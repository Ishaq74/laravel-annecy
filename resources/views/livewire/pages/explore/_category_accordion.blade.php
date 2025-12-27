@php
    $locale = app()->getLocale();
    $hasChildren = $category->children && $category->children->count() > 0;
    $isChecked = in_array($category->slug[$locale] ?? $category->slug, $cats ?? []);
    // Vérifie si un descendant est sélectionné
    function hasCheckedDescendant($category, $cats, $locale) {
        if (!$category->children) return false;
        foreach ($category->children as $child) {
            $slug = $child->slug[$locale] ?? $child->slug;
            if (in_array($slug, $cats ?? [])) return true;
            if (hasCheckedDescendant($child, $cats, $locale)) return true;
        }
        return false;
    }
    $isOpen = $isChecked || hasCheckedDescendant($category, $cats, $locale);
@endphp
<div x-data="{ open: {{ $isOpen ? 'true' : 'false' }} }" class="border-b border-zinc-100 dark:border-zinc-800 pb-2 last:border-0">
    <div class="flex items-center justify-between py-1">
        <div class="flex items-center gap-2">
            @if(!empty($category->icon_name))
                <flux:icon name="{{ $category->icon_name }}" class="size-5 text-zinc-400" />
            @endif
            <flux:checkbox 
                x-ref="checkbox"
                wire:model.live="cats" 
                value="{{ $category->slug[$locale] ?? $category->slug }}" 
                label="{{ $category->name[$locale] ?? $category->name }}"
                size="{{ $level > 0 ? 'sm' : 'md' }}"
                @click="if ($event.target.checked) { open = true; $dispatch('uncheck-parent', '{{ $category->parent ? ($category->parent->slug[$locale] ?? $category->parent->slug) : '' }}') } else { open = false }"
            />
        </div>
        @if($hasChildren)
            <button @click="open = !open" class="text-zinc-400 hover:text-zinc-600" data-has-children>
                <flux:icon.chevron-down class="size-4 transition-transform" x-bind:class="open ? 'rotate-180' : ''" />
            </button>
        @endif
    </div>
    @if($hasChildren)
        <div x-show="open" class="pl-6 space-y-1 mt-1" x-collapse>
            @foreach($category->children as $child)
                @include('livewire.pages.explore._category_accordion', ['category' => $child, 'level' => ($level + 1), 'cats' => $cats])
            @endforeach
        </div>
    @endif
</div>