<?php

use App\Models\Place;

it('affiche la page de détail du lieu', function () {
    $place = Place::factory()->create();

    $response = $this->get("/fr/places/{$place->id}");
    $response->assertSuccessful();
    $response->assertSee('Détail du lieu');
});
