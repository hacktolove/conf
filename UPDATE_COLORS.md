# Update Theme Colors from Logo

## How to Update Colors

The application now uses a centralized color configuration system. To update colors to match your logo:

### Method 1: Update Config File (Recommended)

Edit `config/theme.php` and update the color values:

```php
'colors' => [
    'primary' => '#YOUR_PRIMARY_COLOR',        // Main brand color from logo
    'primary_dark' => '#YOUR_PRIMARY_DARK',    // Darker shade for hover states
    'secondary' => '#YOUR_SECONDARY_COLOR',    // Secondary/accent color
    'dark' => '#YOUR_DARK_COLOR',              // Dark background
    'dark_light' => '#YOUR_DARK_LIGHT',        // Lighter dark shade
    // ... other colors
],
```

### Method 2: Use Environment Variables

Add to your `.env` file:

```env
THEME_PRIMARY=#YOUR_PRIMARY_COLOR
THEME_PRIMARY_DARK=#YOUR_PRIMARY_DARK
THEME_SECONDARY=#YOUR_SECONDARY_COLOR
THEME_DARK=#YOUR_DARK_COLOR
THEME_DARK_LIGHT=#YOUR_DARK_LIGHT
THEME_GRADIENT_PRIMARY_FROM=#YOUR_GRADIENT_FROM
THEME_GRADIENT_PRIMARY_TO=#YOUR_GRADIENT_TO
THEME_GRADIENT_HERO_FROM=#YOUR_HERO_FROM
THEME_GRADIENT_HERO_TO=#YOUR_HERO_TO
```

## Getting Colors from Your Logo PDF

1. **Open the PDF** in Adobe Reader, Chrome, or any PDF viewer
2. **Use a color picker tool:**
   - Windows: Use Snipping Tool or a color picker app
   - Online: Use https://imagecolorpicker.com/ or similar
   - Browser Extension: "ColorZilla" or "Eye Dropper"
3. **Extract the hex codes** from your logo colors
4. **Update the config file** with those hex codes

## Current Default Colors (Academic/University Theme)

The current defaults are set to academic/university colors suitable for a reconstruction conference:

- **Primary**: `#1e40af` (Deep Blue)
- **Primary Dark**: `#1e3a8a` (Darker Blue)
- **Secondary**: `#059669` (Green - representing growth/reconstruction)
- **Dark**: `#0f172a` (Very Dark Blue)
- **Dark Light**: `#1e293b` (Slightly Lighter Dark)

## After Updating Colors

1. Clear cache (if using config cache):
   ```bash
   php artisan config:clear
   ```

2. Refresh your browser to see the changes

## Color Usage

- **Primary**: Used for buttons, links, highlights, active states
- **Primary Dark**: Used for hover states on primary elements
- **Secondary**: Used for accent elements, secondary buttons
- **Dark**: Used for backgrounds, footers, hero sections
- **Gradients**: Used for backgrounds, statistics sections, hero sections

