# PowerShell script to create image directories for Evenza template
# Run: .\setup-image-directories.ps1

$baseDir = Join-Path $PSScriptRoot "storage\app\public"

$directories = @(
    "hero-slides",
    "speakers",
    "sponsors",
    "galleries",
    "blog",
    "events",
    "testimonials"
)

Write-Host "Creating image directories..." -ForegroundColor Green

foreach ($dir in $directories) {
    $fullPath = Join-Path $baseDir $dir
    if (-not (Test-Path $fullPath)) {
        New-Item -ItemType Directory -Path $fullPath -Force | Out-Null
        Write-Host "Created: $fullPath" -ForegroundColor Yellow
    } else {
        Write-Host "Exists: $fullPath" -ForegroundColor Gray
    }
}

Write-Host "`nDirectory structure created!" -ForegroundColor Green
Write-Host "`nNext steps:" -ForegroundColor Cyan
Write-Host "1. Download images from: https://html.awaikenthemes.com/evenza/index.html" -ForegroundColor White
Write-Host "2. Save images to the directories above" -ForegroundColor White
Write-Host "3. Run: php artisan storage:link" -ForegroundColor White
Write-Host "4. Run: php artisan db:seed" -ForegroundColor White

