<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Theme Colors
    |--------------------------------------------------------------------------
    |
    | These colors are used throughout the application. Update these values
    | to match your logo/brand colors.
    |
    */

    'colors' => [
        'primary' => env('THEME_PRIMARY', '#1e40af'),      // Deep Blue - Main brand color (academic/professional)
        'primary_dark' => env('THEME_PRIMARY_DARK', '#1e3a8a'), // Darker blue for hover
        'secondary' => env('THEME_SECONDARY', '#059669'),  // Green - Secondary/accent (growth/reconstruction)
        'dark' => env('THEME_DARK', '#0f172a'),            // Very Dark Blue - Dark background
        'dark_light' => env('THEME_DARK_LIGHT', '#1e293b'), // Lighter dark shade
        'success' => env('THEME_SUCCESS', '#10b981'),      // Success/green
        'warning' => env('THEME_WARNING', '#f59e0b'),      // Warning/orange
        'danger' => env('THEME_DANGER', '#ef4444'),        // Danger/red
        'info' => env('THEME_INFO', '#06b6d4'),            // Info/cyan
    ],

    /*
    |--------------------------------------------------------------------------
    | Gradient Colors
    |--------------------------------------------------------------------------
    |
    | Colors used in gradients throughout the application
    |
    */

    'gradients' => [
        'primary' => [
            'from' => env('THEME_GRADIENT_PRIMARY_FROM', '#1e40af'),
            'to' => env('THEME_GRADIENT_PRIMARY_TO', '#3b82f6'),
        ],
        'hero' => [
            'from' => env('THEME_GRADIENT_HERO_FROM', '#0f172a'),
            'to' => env('THEME_GRADIENT_HERO_TO', '#1e293b'),
        ],
    ],
];

