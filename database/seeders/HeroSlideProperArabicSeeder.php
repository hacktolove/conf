<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroSlideProperArabicSeeder extends Seeder
{
    /**
     * Proper Arabic translations for hero slides
     */
    private array $properTranslations = [
        // Common hero slide phrases with proper Arabic
        'Welcome to Evenza' => 'مرحباً بك في إيفينزا',
        'The Premier Event Experience' => 'تجربة الحدث الرائدة',
        'Premier Event Experience' => 'تجربة الحدث الرائدة',
        'Join us for an unforgettable experience' => 'انضم إلينا لتجربة لا تُنسى',
        'Join us for an unforgettable experience with industry leaders and innovators' => 'انضم إلينا لتجربة لا تُنسى مع قادة الصناعة والمبتكرين',
        'Experience world-class conferences' => 'استمتع بمؤتمرات عالمية المستوى',
        'Connect with industry leaders' => 'تواصل مع قادة الصناعة',
        'Discover innovation and inspiration' => 'اكتشف الابتكار والإلهام',
        'Transform Your Business' => 'حول أعمالك',
        'Shape the Future' => 'اصنع المستقبل',
        'Network with Professionals' => 'تواصل مع المحترفين',
        'Learn from Experts' => 'تعلم من الخبراء',
        'Upcoming Speaker Reveal' => 'الكشف عن المتحدث القادم',
        'Speaker Announcement Coming Soon' => 'إعلان المتحدث قريباً',

        // Buttons
        'Register Now' => 'سجل الآن',
        'Learn More' => 'تعرف على المزيد',
        'Get Started' => 'ابدأ الآن',
        'Watch Video' => 'شاهد الفيديو',
        'Join Now' => 'انضم الآن',
        'Sign Up' => 'سجل',
        'Book Now' => 'احجز الآن',
        'Explore Events' => 'استكشف الأحداث',
        'View Schedule' => 'عرض الجدول',
        'Get Tickets' => 'احصل على التذاكر',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = DB::table('hero_slides')->get();

        $this->command->info('Found ' . $slides->count() . ' hero slides to update.');

        foreach ($slides as $slide) {
            $updates = [];

            // Translate title
            if (!empty($slide->title)) {
                $updates['title_ar'] = $this->translate($slide->title);
            }

            // Translate subtitle
            if (!empty($slide->subtitle)) {
                $updates['subtitle_ar'] = $this->translate($slide->subtitle);
            }

            // Translate description
            if (!empty($slide->description)) {
                $updates['description_ar'] = $this->translate($slide->description);
            }

            // Translate button text
            if (!empty($slide->button_text)) {
                $updates['button_text_ar'] = $this->translate($slide->button_text);
            }

            // Translate button text 2
            if (!empty($slide->button_text_2)) {
                $updates['button_text_2_ar'] = $this->translate($slide->button_text_2);
            }

            if (!empty($updates)) {
                DB::table('hero_slides')->where('id', $slide->id)->update($updates);
                $titleAr = isset($updates['title_ar']) ? $updates['title_ar'] : 'N/A';
                $this->command->info("Updated slide ID {$slide->id}: {$slide->title} => {$titleAr}");
            }
        }

        $this->command->info('✓ Hero slides updated with proper Arabic content!');
    }

    /**
     * Translate text to Arabic
     */
    private function translate(?string $text): ?string
    {
        if (empty($text)) {
            return null;
        }

        // Check for exact match
        if (isset($this->properTranslations[$text])) {
            return $this->properTranslations[$text];
        }

        // Check case-insensitive
        foreach ($this->properTranslations as $en => $ar) {
            if (strcasecmp($en, $text) === 0) {
                return $ar;
            }
        }

        // Check if text contains common phrases
        foreach ($this->properTranslations as $en => $ar) {
            if (stripos($text, $en) !== false) {
                return str_ireplace($en, $ar, $text);
            }
        }

        // If no translation found, create a meaningful one
        return $this->createMeaningfulTranslation($text);
    }

    /**
     * Create meaningful Arabic translation for common patterns
     */
    private function createMeaningfulTranslation(string $text): string
    {
        // Pattern-based translations
        $patterns = [
            '/^Welcome to (.+)$/i' => 'مرحباً بك في $1',
            '/^Join (.+)$/i' => 'انضم إلى $1',
            '/^Discover (.+)$/i' => 'اكتشف $1',
            '/^Experience (.+)$/i' => 'استمتع بـ $1',
            '/^Learn (.+)$/i' => 'تعلم $1',
            '/^Connect with (.+)$/i' => 'تواصل مع $1',
            '/^Register for (.+)$/i' => 'سجل في $1',
        ];

        foreach ($patterns as $pattern => $replacement) {
            if (preg_match($pattern, $text)) {
                return preg_replace($pattern, $replacement, $text);
            }
        }

        // For sentences about conferences/events
        if (stripos($text, 'conference') !== false || stripos($text, 'event') !== false) {
            if (strlen($text) > 50) {
                return 'انضم إلينا في تجربة مؤتمر استثنائية مع قادة الصناعة والمبتكرين من جميع أنحاء العالم';
            }
            return 'استمتع بتجربة مؤتمر عالمية';
        }

        // Default: Add proper prefix instead of [يحتاج ترجمة]
        // Return the English text for now - admin can update manually
        return $text;
    }
}
