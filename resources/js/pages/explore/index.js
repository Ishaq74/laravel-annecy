// Un test qui renvoit hello world dans la console
console.log('Hello World from explore index.js');

window.addEventListener('explore-category-toggled', function (e) {
    if (window.Livewire && typeof window.Livewire.emit === 'function') {
        window.Livewire.emit('explore:categoryToggled', e.detail.id, e.detail.checked);
    }
});

window.addEventListener('explore-search-updated', function (e) {
    if (window.Livewire && typeof window.Livewire.emit === 'function') {
        window.Livewire.emit('explore:searchUpdated', e.detail.query);
    }
});

window.addEventListener('explore-reset-filters', function () {
    if (window.Livewire && typeof window.Livewire.emit === 'function') {
        window.Livewire.emit('explore:resetFilters');
    }
});

window.addEventListener('explore-reset-search', function () {
    if (window.Livewire && typeof window.Livewire.emit === 'function') {
        window.Livewire.emit('explore:resetSearch');
    }
});