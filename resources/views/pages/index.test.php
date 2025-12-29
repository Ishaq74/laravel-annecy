use Livewire\Volt\Volt;

test('home page renders', function () {
    Volt::test('pages.index')
        ->assertSee("Bienvenue sur la page d'accueil");
});
