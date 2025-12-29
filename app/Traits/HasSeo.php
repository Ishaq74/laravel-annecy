<?php

namespace App\Traits;

trait HasSeo
{
    public function getSeoData(?string $locale = null): array
    {
        $locale ??= app()->getLocale();
        $image = $this->getFeaturedImageData();

        return [
            'title' => $this->getSeoValue('seo_title', $locale) ?: $this->getTranslation('name', $locale),
            'description' => $this->getSeoValue('seo_description', $locale) ?: $this->getTranslation('description', $locale),
            'og_title' => $this->getSeoValue('og_title', $locale) ?: $this->getTranslation('name', $locale),
            'og_description' => $this->getSeoValue('og_description', $locale) ?: $this->getTranslation('description', $locale),
            'og_image' => $image['url'],
            'og_image_alt' => $image['alt'],
            'canonical' => url()->current(),
            'dir' => in_array($locale, ['ar']) ? 'rtl' : 'ltr',
        ];
    }

    public function getFeaturedImageData(): array
    {
        $locale = app()->getLocale();

        return [
            'url' => $this->getFirstMediaUrl('featured_image') ?: asset('images/default-city.jpg'),
            'alt' => $this->getSeoValue('featured_image_alt', $locale) ?: $this->getTranslation('name', $locale),
        ];
    }

    protected function getSeoValue(string $key, ?string $locale = null): ?string
    {
        $locale ??= app()->getLocale();

        // try as translatable attribute first
        try {
            $val = $this->getTranslation($key, $locale);
        } catch (\Throwable $e) {
            $val = null;
        }
        if (! empty($val)) {
            return $val;
        }

        // fallback to legacy seo_data json column if present
        $data = $this->seo_data ?? null;
        if (is_array($data) && isset($data[$key])) {
            if (is_array($data[$key])) {
                return $data[$key][$locale] ?? null;
            }

            return is_string($data[$key]) ? $data[$key] : null;
        }

        return null;
    }
}
