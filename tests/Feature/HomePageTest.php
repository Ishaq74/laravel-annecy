<?php

test('renders the homepage in french', function () {
    localizedGetAndSee('home', 'fr', 'Bienvenue');
});

it('renders the homepage in english', function () {
    localizedGetAndSee('home', 'en', 'Welcome');
});

it('renders the homepage in italian', function () {
    localizedGetAndSee('home', 'it', 'Benvenuto');
});

it('home page renders in es', function () {
    localizedGetAndSee('home', 'es', 'Bienvenido');
});

it('renders the homepage in german', function () {
    localizedGetAndSee('home', 'de', 'Willkommen');
});

it('renders the homepage in arabic', function () {
    localizedGetAndSee('home', 'ar', 'مرحب');
});

it('renders the homepage in portuguese', function () {
    localizedGetAndSee('home', 'pt', 'Bem-vindo');
});

it('renders the homepage in chinese', function () {
    localizedGetAndSee('home', 'zh', '欢迎');
});

it('renders the homepage in russian', function () {
    localizedGetAndSee('home', 'ru', 'Добро пожаловать');
});

it('renders the homepage in hindi', function () {
    localizedGetAndSee('home', 'hi', 'स्वागत');
});
