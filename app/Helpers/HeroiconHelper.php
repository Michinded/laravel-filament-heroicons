<?php

namespace App\Helpers;

class HeroiconHelper
{
    /**
     * Get all icons as an array for select fields
     *
     * @param bool $translate Whether to translate icon names
     * @return array
     */
    public static function getIconsForSelect(bool $translate = true): array
    {
        $icons = config('filament_heroicons.icons', []);
        
        if (!$translate) {
            return array_combine(array_keys($icons), array_keys($icons));
        }

        return array_combine(
            array_keys($icons),
            array_map(fn($key) => __($key), array_values($icons))
        );
    }

    /**
     * Get icons by category
     *
     * @param string $category
     * @param bool $translate
     * @return array
     */
    public static function getIconsByCategory(string $category, bool $translate = true): array
    {
        $categories = config('filament_heroicons.categories', []);
        $icons = $categories[$category] ?? [];
        
        return array_combine(
            $icons,
            array_map(
                fn($icon) => $translate ? __('filament_heroicons.' . str_replace('heroicon-o-', '', $icon)) : $icon,
                $icons
            )
        );
    }

    /**
     * Get all categories with their icons
     *
     * @param bool $translate
     * @return array
     */
    public static function getAllCategorizedIcons(bool $translate = true): array
    {
        $categories = config('filament_heroicons.categories', []);
        $result = [];

        foreach ($categories as $category => $icons) {
            $result[__('filament_heroicons.categories.' . $category)] = static::getIconsByCategory($category, $translate);
        }

        return $result;
    }

    /**
     * Get available categories
     *
     * @param bool $translate
     * @return array
     */
    public static function getCategories(bool $translate = true): array
    {
        $categories = array_keys(config('filament_heroicons.categories', []));
        
        if (!$translate) {
            return array_combine($categories, $categories);
        }

        return array_combine(
            $categories,
            array_map(fn($category) => __('filament_heroicons.categories.' . $category), $categories)
        );
    }

    /**
     * Search icons by name or category
     *
     * @param string $query
     * @param bool $translate
     * @return array
     */
    public static function searchIcons(string $query, bool $translate = true): array
    {
        $icons = static::getIconsForSelect($translate);
        $categories = static::getAllCategorizedIcons($translate);
        $results = [];

        // Search in all icons
        foreach ($icons as $key => $value) {
            if (stripos($key, $query) !== false || stripos($value, $query) !== false) {
                $results[$key] = $value;
            }
        }

        // Search in categories
        foreach ($categories as $category => $categoryIcons) {
            if (stripos($category, $query) !== false) {
                $results = array_merge($results, $categoryIcons);
            }
        }

        return array_unique($results);
    }

    /**
     * Get category metadata
     *
     * @param string|null $category
     * @param bool $translate
     * @return array
     */
    public static function getCategoryMetadata(?string $category = null, bool $translate = true): array
    {
        $metadata = config('filament_heroicons.category_metadata', []);
        
        if ($category) {
            return $metadata[$category] ?? [];
        }

        if ($translate) {
            return array_map(function($meta) {
                return [
                    'label' => __('filament_heroicons.' . $meta['label']),
                    'description' => __('filament_heroicons.' . $meta['description'])
                ];
            }, $metadata);
        }

        return $metadata;
    }
}