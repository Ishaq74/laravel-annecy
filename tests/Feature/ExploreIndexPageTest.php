<?php

it('renders the ExploreIndexPage in french', function () {
    localizedGetAndSee('explore', 'fr', 'Filtrer');
});

it('renders the ExploreIndexPage in english', function () {
    localizedGetAndSee('explore', 'en', 'Filter');
});

it('renders the ExploreIndexPage in italian', function () {
    localizedGetAndSee('explore', 'it', 'Filtra');
});

it('renders the ExploreIndexPage in spanish', function () {
    localizedGetAndSee('explore', 'es', 'Filtrar');
});

it('renders the ExploreIndexPage in german', function () {
    localizedGetAndSee('explore', 'de', 'Filtern');
});

it('renders the ExploreIndexPage in arabic', function () {
    localizedGetAndSee('explore', 'ar', 'تصفية');
});

it('renders the ExploreIndexPage in portuguese', function () {
    localizedGetAndSee('explore', 'pt', 'Filtrar');
});

it('renders the ExploreIndexPage in chinese', function () {
    localizedGetAndSee('explore', 'zh', '筛选');
});

it('renders the ExploreIndexPage in russian', function () {
    localizedGetAndSee('explore', 'ru', 'Фильтровать');
});

it('renders the ExploreIndexPage in hindi', function () {
    localizedGetAndSee('explore', 'hi', 'फ़िल्टर करें');
});


it('renders places in french', function () {
    localizedGetAndDontSee('explore', 'fr', 'Aucun résultat trouvé.');
});

it('renders categories in french', function () {
    localizedGetAndDontSee('explore', 'fr', 'Aucune catégorie disponible.');
});