<?php

namespace App\Traits;

trait HasSeo
{
    public function getSeoData(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $image = $this->getFeaturedImageData();

        return [
            'title'           => $this->getTranslation('seo_title', $locale) ?: $this->getTranslation('name', $locale),
            'description'     => $this->getTranslation('seo_description', $locale) ?: $this->getTranslation('description', $locale),
            'og_title'        => $this->getTranslation('og_title', $locale) ?: $this->getTranslation('name', $locale),
            'og_description'  => $this->getTranslation('og_description', $locale) ?: $this->getTranslation('description', $locale),
            'og_image'        => $image['url'],
            'og_image_alt'    => $image['alt'],
            'canonical'       => url()->current(),
            'dir'             => in_array($locale, ['ar']) ? 'rtl' : 'ltr',
        ];
    }

    public function getFeaturedImageData(): array
    {
        $locale = app()->getLocale();
        return [
            'url' => $this->getFirstMediaUrl('featured_image') ?: asset('images/default-city.jpg'),
            'alt' => $this->getTranslation('featured_image_alt', $locale) ?: $this->getTranslation('name', $locale),
        ];
    }
}