<?php

namespace Database\Seeders;

class ArabicTranslationHelper
{
    /**
     * Comprehensive translation dictionary
     */
    private static array $translations = [
        // Hero Slides Common Phrases
        'Welcome to Evenza' => 'مرحباً بك في إيفينزا',
        'The Premier Event Experience' => 'تجربة الحدث الرائدة',
        'Join us for an unforgettable experience' => 'انضم إلينا لتجربة لا تُنسى',
        'Join us for an unforgettable experience with industry leaders and innovators' => 'انضم إلينا لتجربة لا تُنسى مع قادة الصناعة والمبتكرين',
        'Experience world-class conferences' => 'استمتع بمؤتمرات عالمية المستوى',
        'Connect with industry leaders' => 'تواصل مع قادة الصناعة',
        'Discover innovation and inspiration' => 'اكتشف الابتكار والإلهام',

        // Action Buttons
        'Register Now' => 'سجل الآن',
        'Learn More' => 'تعرف على المزيد',
        'Get Started' => 'ابدأ الآن',
        'Watch Video' => 'شاهد الفيديو',
        'Join Now' => 'انضم الآن',
        'Sign Up' => 'سجل',
        'Book Now' => 'احجز الآن',
        'Read More' => 'اقرأ المزيد',
        'View Details' => 'عرض التفاصيل',
        'Explore Events' => 'استكشف الأحداث',

        // Event Types
        'Annual Conference' => 'المؤتمر السنوي',
        'Tech Conference' => 'مؤتمر التكنولوجيا',
        'Business Summit' => 'قمة الأعمال',
        'Workshop' => 'ورشة عمل',
        'Seminar' => 'ندوة',
        'Webinar' => 'ندوة عبر الإنترنت',
        'Networking Event' => 'حدث للتواصل',
        'Panel Discussion' => 'مناقشة جماعية',
        'Keynote Session' => 'جلسة رئيسية',

        // Venues
        'Main Hall' => 'القاعة الرئيسية',
        'Conference Room' => 'قاعة المؤتمرات',
        'Meeting Room' => 'قاعة الاجتماعات',
        'Auditorium' => 'القاعة الكبرى',
        'Exhibition Hall' => 'قاعة المعارض',
        'Virtual Event' => 'حدث افتراضي',

        // Job Titles
        'CEO' => 'الرئيس التنفيذي',
        'Chief Executive Officer' => 'الرئيس التنفيذي',
        'Founder' => 'المؤسس',
        'Co-Founder' => 'المؤسس المشارك',
        'Director' => 'مدير',
        'Managing Director' => 'المدير العام',
        'Manager' => 'مدير',
        'Senior Manager' => 'مدير أول',
        'Expert' => 'خبير',
        'Senior Expert' => 'خبير أول',
        'Consultant' => 'مستشار',
        'Senior Consultant' => 'مستشار أول',
        'Speaker' => 'متحدث',
        'Keynote Speaker' => 'متحدث رئيسي',
        'VP' => 'نائب الرئيس',
        'Vice President' => 'نائب الرئيس',
        'President' => 'رئيس',
        'Head of' => 'رئيس قسم',
        'Lead' => 'قائد',
        'Team Lead' => 'قائد الفريق',

        // Industries & Sectors
        'Technology' => 'التكنولوجيا',
        'Information Technology' => 'تكنولوجيا المعلومات',
        'Innovation' => 'الابتكار',
        'Business' => 'الأعمال',
        'Marketing' => 'التسويق',
        'Digital Marketing' => 'التسويق الرقمي',
        'Development' => 'التطوير',
        'Software Development' => 'تطوير البرمجيات',
        'Design' => 'التصميم',
        'Strategy' => 'الاستراتيجية',
        'Leadership' => 'القيادة',
        'Management' => 'الإدارة',
        'Finance' => 'المالية',
        'Healthcare' => 'الرعاية الصحية',
        'Education' => 'التعليم',
        'Media' => 'الإعلام',
        'Entertainment' => 'الترفيه',
        'Consulting' => 'الاستشارات',

        // Common Descriptions
        'Join industry leaders and innovators' => 'انضم إلى قادة الصناعة والمبتكرين',
        'Network with professionals' => 'تواصل مع المحترفين',
        'Learn from experts' => 'تعلم من الخبراء',
        'Discover new opportunities' => 'اكتشف فرص جديدة',
        'Transform your business' => 'حول أعمالك',
        'Shape the future' => 'اصنع المستقبل',
        'Inspiring innovation' => 'إلهام الابتكار',
        'Empowering professionals' => 'تمكين المحترفين',
        'Building connections' => 'بناء الروابط',

        // Categories
        'General' => 'عام',
        'Business' => 'الأعمال',
        'Technology' => 'التكنولوجيا',
        'Marketing' => 'التسويق',
        'Innovation' => 'الابتكار',
        'Leadership' => 'القيادة',
        'Entrepreneurship' => 'ريادة الأعمال',

        // Common Words
        'and' => 'و',
        'the' => '',
        'in' => 'في',
        'at' => 'في',
        'for' => 'لـ',
        'with' => 'مع',
        'from' => 'من',
        'to' => 'إلى',
    ];

    /**
     * Translate English text to Arabic
     */
    public static function translate(?string $text): ?string
    {
        if (empty($text)) {
            return null;
        }

        // Check for exact match first
        if (isset(self::$translations[$text])) {
            return self::$translations[$text];
        }

        // Try case-insensitive match
        foreach (self::$translations as $en => $ar) {
            if (strcasecmp($en, $text) === 0) {
                return $ar;
            }
        }

        // For multi-word phrases, try to translate word by word
        $words = explode(' ', $text);
        if (count($words) > 1) {
            $translatedWords = [];
            $allTranslated = true;

            foreach ($words as $word) {
                $cleanWord = trim($word, '.,!?;:');
                if (isset(self::$translations[$cleanWord])) {
                    $translatedWords[] = self::$translations[$cleanWord];
                } elseif (!empty(self::translateCommonWord($cleanWord))) {
                    $translatedWords[] = self::translateCommonWord($cleanWord);
                } else {
                    $allTranslated = false;
                    break;
                }
            }

            if ($allTranslated && !empty($translatedWords)) {
                return implode(' ', array_filter($translatedWords));
            }
        }

        // If no translation found, return with [AR] prefix to indicate manual translation needed
        return '[يحتاج ترجمة] ' . $text;
    }

    /**
     * Translate common individual words
     */
    private static function translateCommonWord(string $word): ?string
    {
        $commonWords = [
            'conference' => 'مؤتمر',
            'event' => 'حدث',
            'summit' => 'قمة',
            'workshop' => 'ورشة عمل',
            'seminar' => 'ندوة',
            'speaker' => 'متحدث',
            'expert' => 'خبير',
            'leader' => 'قائد',
            'professional' => 'محترف',
            'manager' => 'مدير',
            'director' => 'مدير',
            'president' => 'رئيس',
            'founder' => 'مؤسس',
            'annual' => 'سنوي',
            'international' => 'دولي',
            'global' => 'عالمي',
            'digital' => 'رقمي',
            'virtual' => 'افتراضي',
            'online' => 'عبر الإنترنت',
            'live' => 'مباشر',
        ];

        $lowerWord = strtolower($word);
        return $commonWords[$lowerWord] ?? null;
    }

    /**
     * Add custom translation to dictionary
     */
    public static function addTranslation(string $english, string $arabic): void
    {
        self::$translations[$english] = $arabic;
    }

    /**
     * Get all translations
     */
    public static function getAllTranslations(): array
    {
        return self::$translations;
    }
}
