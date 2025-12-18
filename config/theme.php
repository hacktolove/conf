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
        'primary' => env('THEME_PRIMARY', '#52c463'),      // Lighter Green - Primary brand color (eye-friendly)
        'primary_dark' => env('THEME_PRIMARY_DARK', '#3a9a48'), // Darker green for hover (~25% darker)
        'secondary' => env('THEME_SECONDARY', '#F79222'),  // Orange - Secondary color
        'dark' => env('THEME_DARK', '#0d1a2e'),            // Very Dark Blue - Dark background
        'dark_light' => env('THEME_DARK_LIGHT', '#1a2d4a'), // Lighter dark shade
        'success' => env('THEME_SUCCESS', '#52c463'),      // Success/green (use primary green)
        'warning' => env('THEME_WARNING', '#F79222'),      // Warning/orange (secondary color)
        'danger' => env('THEME_DANGER', '#ef4444'),        // Danger/red
        'info' => env('THEME_INFO', '#29559E'),            // Info/blue (third color)
        'accent' => env('THEME_ACCENT', '#29559E'),        // Accent/third color (blue)
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
            'from' => env('THEME_GRADIENT_PRIMARY_FROM', '#52c463'),  // Lighter green (primary)
            'to' => env('THEME_GRADIENT_PRIMARY_TO', '#6dd47a'),      // Even lighter green (~10% lighter)
        ],
        'hero' => [
            'from' => env('THEME_GRADIENT_HERO_FROM', '#0d1a2e'),     // Dark blue (keep for contrast)
            'to' => env('THEME_GRADIENT_HERO_TO', '#1a2d4a'),         // Lighter dark blue
        ],
    ],
];

