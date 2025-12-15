<?php
/**
 * Script to download images from Evenza template
 * Run: php download_template_images.php
 */

$templateUrl = 'https://html.awaikenthemes.com/evenza/';
$baseDir = __DIR__ . '/storage/app/public/';

// Create directories
$directories = [
    'hero-slides',
    'speakers',
    'sponsors',
    'galleries',
    'blog',
    'events',
    'testimonials'
];

foreach ($directories as $dir) {
    $path = $baseDir . $dir;
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
        echo "Created directory: $path\n";
    }
}

// Image URLs from template (you'll need to inspect the template and add actual URLs)
$images = [
    // Hero slides
    'hero-slides/hero-1.jpg' => $templateUrl . 'assets/images/hero/hero-1.jpg',
    
    // Speakers
    'speakers/sophia-rodrigues.jpg' => $templateUrl . 'assets/images/speakers/speaker-1.jpg',
    'speakers/jacob-jones.jpg' => $templateUrl . 'assets/images/speakers/speaker-2.jpg',
    'speakers/arlene-mccoy.jpg' => $templateUrl . 'assets/images/speakers/speaker-3.jpg',
    
    // Sponsors
    'sponsors/sponsor-1.png' => $templateUrl . 'assets/images/sponsors/sponsor-1.png',
    'sponsors/sponsor-2.png' => $templateUrl . 'assets/images/sponsors/sponsor-2.png',
    'sponsors/sponsor-3.png' => $templateUrl . 'assets/images/sponsors/sponsor-3.png',
    'sponsors/sponsor-4.png' => $templateUrl . 'assets/images/sponsors/sponsor-4.png',
    'sponsors/sponsor-5.png' => $templateUrl . 'assets/images/sponsors/sponsor-5.png',
    'sponsors/sponsor-6.png' => $templateUrl . 'assets/images/sponsors/sponsor-6.png',
    
    // Galleries
    'galleries/gallery-1.jpg' => $templateUrl . 'assets/images/gallery/gallery-1.jpg',
    'galleries/gallery-2.jpg' => $templateUrl . 'assets/images/gallery/gallery-2.jpg',
    'galleries/gallery-3.jpg' => $templateUrl . 'assets/images/gallery/gallery-3.jpg',
    'galleries/gallery-4.jpg' => $templateUrl . 'assets/images/gallery/gallery-4.jpg',
    'galleries/gallery-5.jpg' => $templateUrl . 'assets/images/gallery/gallery-5.jpg',
    'galleries/gallery-6.jpg' => $templateUrl . 'assets/images/gallery/gallery-6.jpg',
    
    // Blog
    'blog/blog-1.jpg' => $templateUrl . 'assets/images/blog/blog-1.jpg',
    'blog/blog-2.jpg' => $templateUrl . 'assets/images/blog/blog-2.jpg',
    'blog/blog-3.jpg' => $templateUrl . 'assets/images/blog/blog-3.jpg',
];

function downloadImage($url, $destination) {
    if (file_exists($destination)) {
        echo "Skipping (exists): $destination\n";
        return true;
    }
    
    $ch = curl_init($url);
    $fp = fopen($destination, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($fp);
    
    if ($httpCode === 200 && file_exists($destination)) {
        echo "Downloaded: $destination\n";
        return true;
    } else {
        echo "Failed to download: $url (HTTP $httpCode)\n";
        @unlink($destination);
        return false;
    }
}

echo "Starting image download...\n\n";

foreach ($images as $localPath => $url) {
    $fullPath = $baseDir . $localPath;
    $dir = dirname($fullPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    downloadImage($url, $fullPath);
}

echo "\nDone! Please inspect the template and update the URLs in this script with actual image paths.\n";
echo "You can find image URLs by:\n";
echo "1. Opening https://html.awaikenthemes.com/evenza/index.html in browser\n";
echo "2. Right-clicking on images and selecting 'Inspect' or 'Copy image address'\n";
echo "3. Updating the \$images array in this script with correct URLs\n";

