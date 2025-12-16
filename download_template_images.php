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
    'testimonials',
    'about'
];

foreach ($directories as $dir) {
    $path = $baseDir . $dir;
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
        echo "Created directory: $path\n";
    }
}

// Image URLs from template - extracted from the template structure
$images = [
    // Hero slides
    'hero-slides/hero-1.jpg' => $templateUrl . 'assets/images/hero/hero-1.jpg',

    // Speakers
    'speakers/speaker-1.jpg' => $templateUrl . 'assets/images/speakers/speaker-1.jpg',
    'speakers/speaker-2.jpg' => $templateUrl . 'assets/images/speakers/speaker-2.jpg',
    'speakers/speaker-3.jpg' => $templateUrl . 'assets/images/speakers/speaker-3.jpg',
    'speakers/speaker-4.jpg' => $templateUrl . 'assets/images/speakers/speaker-4.jpg',
    'speakers/speaker-5.jpg' => $templateUrl . 'assets/images/speakers/speaker-5.jpg',

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

    // About
    'about/about-1.jpg' => $templateUrl . 'assets/images/about/about-1.jpg',

    // Testimonials
    'testimonials/testimonial-1.jpg' => $templateUrl . 'assets/images/testimonials/testimonial-1.jpg',
    'testimonials/testimonial-2.jpg' => $templateUrl . 'assets/images/testimonials/testimonial-2.jpg',
    'testimonials/testimonial-3.jpg' => $templateUrl . 'assets/images/testimonials/testimonial-3.jpg',
];

/**
 * Download a file from URL
 */
function downloadFile($url, $destination) {
    $ch = curl_init($url);
    $fp = fopen($destination, 'wb');

    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);
    fclose($fp);

    return $httpCode === 200 && $result !== false;
}

echo "Starting image download...\n\n";

$successCount = 0;
$failCount = 0;
$skippedCount = 0;

foreach ($images as $relativePath => $url) {
    $fullPath = $baseDir . $relativePath;

    // Skip if file already exists
    if (file_exists($fullPath)) {
        echo "Skipped (exists): $relativePath\n";
        $skippedCount++;
        continue;
    }

    // Create directory if it doesn't exist
    $dir = dirname($fullPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    echo "Downloading: $relativePath... ";

    if (downloadFile($url, $fullPath)) {
        $size = filesize($fullPath);
        if ($size > 0) {
            echo "✓ Success (" . number_format($size / 1024, 2) . " KB)\n";
            $successCount++;
        } else {
            echo "✗ Failed (empty file)\n";
            @unlink($fullPath);
            $failCount++;
        }
    } else {
        echo "✗ Failed\n";
        $failCount++;
    }
}

echo "\n";
echo "========================================\n";
echo "Download Summary:\n";
echo "Success: $successCount\n";
echo "Failed: $failCount\n";
echo "Skipped: $skippedCount\n";
echo "Total: " . count($images) . "\n";
echo "========================================\n";

if ($failCount > 0) {
    echo "\nNote: Some images failed to download. You may need to:\n";
    echo "1. Check your internet connection\n";
    echo "2. Verify the template URLs are accessible\n";
    echo "3. Manually download missing images\n";
}
