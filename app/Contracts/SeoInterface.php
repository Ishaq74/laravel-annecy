<?php

namespace App\Contracts;

interface SeoInterface
{
    /**
     * Retourne toutes les balises meta, OG et Twitter.
     */
    public function getSeoData(): array;

    /**
     * Retourne le JSON-LD pour Schema.org.
     */
    public function getSchemaMarkup(): array;

    /**
     * Définit l'image de mise en avant et son texte alternatif pour l'accessibilité.
     */
    public function getFeaturedImageData(): array;
}