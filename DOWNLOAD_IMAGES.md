# Download Images from Evenza Template

## Instructions to Download Images

1. **Open the template in your browser:**
   - Go to: https://html.awaikenthemes.com/evenza/index.html

2. **Download images using browser developer tools:**
   - Press `F12` to open Developer Tools
   - Go to the "Network" tab
   - Filter by "Img" to see only images
   - Refresh the page
   - Right-click on each image and select "Open in new tab"
   - Save the images to the appropriate folders

3. **Create the following directory structure in `storage/app/public/`:**

```
storage/app/public/
├── hero-slides/
│   └── hero-1.jpg
├── speakers/
│   ├── sophia-rodrigues.jpg
│   ├── jacob-jones.jpg
│   ├── arlene-mccoy.jpg
│   ├── ralph-edwards.jpg
│   └── kristin-watson.jpg
├── sponsors/
│   ├── sponsor-1.png
│   ├── sponsor-2.png
│   ├── sponsor-3.png
│   ├── sponsor-4.png
│   ├── sponsor-5.png
│   └── sponsor-6.png
├── galleries/
│   ├── gallery-1.jpg
│   ├── gallery-2.jpg
│   ├── gallery-3.jpg
│   ├── gallery-4.jpg
│   ├── gallery-5.jpg
│   └── gallery-6.jpg
└── blog/
    ├── mastering-public-speaking.jpg
    ├── self-defense-skills.jpg
    └── networking-power.jpg
```

4. **Alternative: Use the download script**
   - Run: `php download_template_images.php`
   - Note: You'll need to update the image URLs in the script first by inspecting the template

5. **After downloading images:**
   - Run: `php artisan storage:link` (if not already done)
   - This creates a symbolic link from `public/storage` to `storage/app/public`

## Quick Method Using Browser Extension

You can also use browser extensions like:
- **Image Downloader** (Chrome/Edge)
- **Download All Images** (Firefox)

These extensions can download all images from a page at once.

## Image Paths Used in Seeder

The seeder expects images at these paths (relative to `storage/app/public/`):

- Hero slides: `hero-slides/hero-1.jpg`
- Speakers: `speakers/{speaker-slug}.jpg`
- Sponsors: `sponsors/sponsor-{1-6}.png`
- Galleries: `galleries/gallery-{1-6}.jpg`
- Blog: `blog/{post-slug}.jpg`

Make sure to match these exact paths when downloading images!

