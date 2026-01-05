<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Schedule;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\Sponsor;
use App\Models\Gallery;
use App\Models\Faq;
use App\Models\HeroSlide;
use App\Models\Statistic;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@evenza.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Site Settings
        $settings = [
            'site_name' => ['en' => 'Evenza', 'ar' => 'إيفنزا'],
            'site_tagline' => ['en' => 'Ideas that spark change.', 'ar' => 'أفكار تشعل التغيير.'],
            'site_description' => [
                'en' => 'Experience a powerful gathering of visionaries, creators, and industry experts united by one goal—exchanging ideas that spark growth, innovation, and meaningful change.',
                'ar' => 'اختبر تجمعًا قويًا من الرؤساء والمبدعين وخبراء الصناعة متحدين بهدف واحد - تبادل الأفكار التي تشعل النمو والابتكار والتغيير الهادف.'
            ],
            'contact_email' => 'support@domainname.com',
            'contact_phone' => '+00 123 456 789',
            'contact_address' => [
                'en' => '45/2 Central Business Innovation Near International Trade Tower',
                'ar' => '45/2 الابتكار التجاري المركزي بالقرب من برج التجارة الدولية'
            ],
            'social_facebook' => 'https://facebook.com/evenza',
            'social_twitter' => 'https://twitter.com/evenza',
            'social_instagram' => 'https://instagram.com/evenza',
            'social_linkedin' => 'https://linkedin.com/company/evenza',
            'social_youtube' => 'https://youtube.com/evenza',
            'countdown_date' => now()->addMonths(3)->format('Y-m-d H:i:s'),
            'mission' => [
                'en' => 'Our mission is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.',
                'ar' => 'مهمتنا هي بناء مجتمع عالمي حيث يغذي التعاون الابتكار، نهدف إلى تشجيع التفكير الجديد، وإثارة الحوارات الملهمة، وخلق مساحة.'
            ],
            'vision' => [
                'en' => 'Our vision is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.',
                'ar' => 'رؤيتنا هي بناء مجتمع عالمي حيث يغذي التعاون الابتكار، نهدف إلى تشجيع التفكير الجديد، وإثارة الحوارات الملهمة، وخلق مساحة.'
            ],
            'goal' => [
                'en' => 'Our goal is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.',
                'ar' => 'هدفنا هو بناء مجتمع عالمي حيث يغذي التعاون الابتكار، نهدف إلى تشجيع التفكير الجديد، وإثارة الحوارات الملهمة، وخلق مساحة.'
            ],
        ];

        foreach ($settings as $key => $value) {
            if (is_array($value) && isset($value['en']) && isset($value['ar'])) {
                SiteSetting::set($key, $value['en'], 'text', 'general', $value['ar']);
            } else {
                SiteSetting::set($key, $value);
            }
        }

        // Hero Slides
        $heroSlides = [
            [
                'title' => 'Connecting Minds to Shape Tomorrow\'s Big Ideas',
                'title_ar' => 'ربط العقول لتشكيل الأفكار الكبيرة للغد',
                'subtitle' => 'Ideas that spark change.',
                'subtitle_ar' => 'أفكار تشعل التغيير.',
                'description' => 'Experience a powerful gathering of visionaries, creators, and industry experts united by one goal—exchanging ideas that spark growth, innovation, and meaningful change.',
                'description_ar' => 'اختبر تجمعًا قويًا يجمع بين الرؤساء والمبدعين والخبراء في الصناعة متحدين بهدف واحد - تبادل الأفكار التي تشعل النمو والابتكار والتغيير الهادف.',
                'image' => 'hero-slides/hero-1.jpg',
                'button_text' => 'Explore Schedule',
                'button_text_ar' => 'استكشف الجدول',
                'button_link' => '/schedule',
                'button_text_2' => 'Watch Video',
                'button_text_2_ar' => 'شاهد الفيديو',
                'button_link_2' => '#',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Innovation Summit 2025: Where Ideas Meet Opportunity',
                'title_ar' => 'قمة الابتكار 2025: حيث تلتقي الأفكار بالفرصة',
                'subtitle' => 'Join the future of innovation.',
                'subtitle_ar' => 'انضم إلى مستقبل الابتكار.',
                'description' => 'Discover cutting-edge technologies, network with industry leaders, and unlock new possibilities at the most anticipated innovation event of the year.',
                'description_ar' => 'اكتشف أحدث التقنيات، وتواصل مع قادة الصناعة، وافتح إمكانيات جديدة في الحدث الأكثر توقعًا للابتكار لهذا العام.',
                'image' => 'hero-slides/hero-2.jpg',
                'button_text' => 'Register Now',
                'button_text_ar' => 'سجل الآن',
                'button_link' => '/contact',
                'button_text_2' => 'Learn More',
                'button_text_2_ar' => 'اعرف المزيد',
                'button_link_2' => '/about',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Empower Your Career with Expert-Led Workshops',
                'title_ar' => 'مكن مسيرتك المهنية مع ورش العمل بقيادة الخبراء',
                'subtitle' => 'Transform your professional journey.',
                'subtitle_ar' => 'حول رحلتك المهنية.',
                'description' => 'Learn from world-class experts, gain practical skills, and accelerate your career growth through hands-on workshops and interactive sessions.',
                'description_ar' => 'تعلم من خبراء عالميين، واكتسب مهارات عملية، وسرع نمو مسيرتك المهنية من خلال ورش العمل التفاعلية والجلسات التفاعلية.',
                'image' => 'hero-slides/hero-3.jpg',
                'button_text' => 'View Speakers',
                'button_text_ar' => 'عرض المتحدثين',
                'button_link' => '/speakers',
                'button_text_2' => 'Browse Sessions',
                'button_text_2_ar' => 'تصفح الجلسات',
                'button_link_2' => '/schedule',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Network with Global Leaders and Industry Pioneers',
                'title_ar' => 'تواصل مع القادة العالميين ورائدات الصناعة',
                'subtitle' => 'Build connections that matter.',
                'subtitle_ar' => 'ابني علاقات مهمة.',
                'description' => 'Connect with like-minded professionals, share insights, and build lasting relationships that will shape your future success.',
                'description_ar' => 'تواصل مع المهنيين ذوي التفكير المماثل، وشارك الرؤى، وابني علاقات دائمة ستشكل نجاحك المستقبلي.',
                'image' => 'hero-slides/hero-4.jpg',
                'button_text' => 'Join Us',
                'button_text_ar' => 'انضم إلينا',
                'button_link' => '/contact',
                'button_text_2' => 'Our Story',
                'button_text_2_ar' => 'قصتنا',
                'button_link_2' => '/about',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Transform Your Vision into Reality',
                'title_ar' => 'حول رؤيتك إلى واقع',
                'subtitle' => 'Your journey starts here.',
                'subtitle_ar' => 'رحلتك تبدأ من هنا.',
                'description' => 'Join thousands of professionals who are taking their careers to the next level. Get inspired, learn new skills, and unlock your full potential.',
                'description_ar' => 'انضم إلى آلاف المهنيين الذين يأخذون مسيراتهم المهنية إلى المستوى التالي. احصل على الإلهام، وتعلم مهارات جديدة، وافتح إمكانياتك الكاملة.',
                'image' => 'hero-slides/hero-5.jpg',
                'button_text' => 'Get Started',
                'button_text_ar' => 'ابدأ الآن',
                'button_link' => '/contact',
                'button_text_2' => 'Explore Events',
                'button_text_2_ar' => 'استكشف الأحداث',
                'button_link_2' => '/events',
                'is_active' => true,
                'order' => 5,
            ],
        ];

        foreach ($heroSlides as $slide) {
            HeroSlide::updateOrCreate(
                ['title' => $slide['title'], 'order' => $slide['order']],
                $slide
            );
        }

        // Statistics
        $statistics = [
            ['title' => '"Institute for Professional Achievement Awards 2025"', 'value' => '25', 'suffix' => '+', 'icon' => 'bi-trophy', 'order' => 1, 'is_active' => true],
            ['title' => 'Attendees Connected Worldwide', 'value' => '15000', 'suffix' => '+', 'icon' => 'bi-people', 'order' => 2, 'is_active' => true],
            ['title' => 'Our Review', 'value' => '4200', 'suffix' => '', 'icon' => 'bi-star', 'order' => 3, 'is_active' => true],
            ['title' => 'Rating', 'value' => '4.9', 'suffix' => '/5', 'icon' => 'bi-star-fill', 'order' => 4, 'is_active' => true],
        ];

        foreach ($statistics as $stat) {
            Statistic::updateOrCreate(
                ['title' => $stat['title']],
                $stat
            );
        }

        // Events
        $events = [
            [
                'title' => 'Professional Skills Development Workshop',
                'title_ar' => 'ورشة تطوير المهارات المهنية',
                'slug' => 'professional-skills-development-workshop',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'short_description_ar' => 'اطلق إمكانياتك وارتق بمهنتك مع ورشة تطوير المهارات المهنية المصممة للطلاب والمهنيين العاملين.',
                'description' => "Unlock your potential and elevate your career with our Professional Skills Development Workshop designed for students and working professionals.\n\nThis comprehensive workshop covers essential skills including communication, leadership, time management, and professional development strategies.",
                'description_ar' => "اطلق إمكانياتك وارتق بمهنتك مع ورشة تطوير المهارات المهنية المصممة للطلاب والمهنيين العاملين.\n\nتغطي هذه الورشة الشاملة المهارات الأساسية بما في ذلك التواصل والقيادة وإدارة الوقت واستراتيجيات التطوير المهني.",
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
                'address_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'event_date' => Carbon::create(2025, 3, 22),
                'start_time' => '09:00',
                'end_time' => '17:30',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Leadership & Growth Conference',
                'title_ar' => 'مؤتمر القيادة والنمو',
                'slug' => 'leadership-growth-conference',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'short_description_ar' => 'انضم إلينا في مؤتمر القيادة والنمو حيث يشارك قادة الصناعة رؤاهم حول بناء فرق ناجحة ودفع النمو التنظيمي.',
                'description' => "Join us for the Leadership & Growth Conference where industry leaders share insights on building successful teams and driving organizational growth.",
                'description_ar' => 'انضم إلينا في مؤتمر القيادة والنمو حيث يشارك قادة الصناعة رؤاهم حول بناء فرق ناجحة ودفع النمو التنظيمي.',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
                'address_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'event_date' => Carbon::create(2025, 5, 5),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing Masterclass',
                'title_ar' => 'فصل رئيسي في التسويق الرقمي',
                'slug' => 'digital-marketing-masterclass',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'short_description_ar' => 'أتقن فن التسويق الرقمي في هذا الفصل الرئيسي الشامل الذي يغطي تحسين محركات البحث والتسويق عبر وسائل التواصل الاجتماعي واستراتيجية المحتوى والتحليلات.',
                'description' => "Master the art of digital marketing in this comprehensive masterclass covering SEO, social media marketing, content strategy, and analytics.",
                'description_ar' => 'أتقن فن التسويق الرقمي في هذا الفصل الرئيسي الشامل الذي يغطي تحسين محركات البحث والتسويق عبر وسائل التواصل الاجتماعي واستراتيجية المحتوى والتحليلات.',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
                'address_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'event_date' => Carbon::create(2025, 6, 20),
                'start_time' => '08:30',
                'end_time' => '18:00',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Annual Innovation Summit 2025',
                'title_ar' => 'قمة الابتكار السنوية 2025',
                'slug' => 'annual-innovation-summit-2025',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'short_description_ar' => 'تجمع قمة الابتكار السنوية المبتكرين ورجال الأعمال وقادة الفكر لاستكشاف أحدث الاتجاهات والتقنيات التي تشكل مستقبلنا.',
                'description' => "The Annual Innovation Summit brings together innovators, entrepreneurs, and thought leaders to explore the latest trends and technologies shaping our future.",
                'description_ar' => 'تجمع قمة الابتكار السنوية المبتكرين ورجال الأعمال وقادة الفكر لاستكشاف أحدث الاتجاهات والتقنيات التي تشكل مستقبلنا.',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
                'address_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'event_date' => Carbon::create(2025, 4, 10),
                'start_time' => '11:00',
                'end_time' => '15:00',
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($events as $eventData) {
            Event::updateOrCreate(
                ['slug' => $eventData['slug']],
                $eventData
            );
        }

        // Speakers
        $speakers = [
            [
                'name' => 'Sophia Rodrigues',
                'name_ar' => 'صوفيا رودريغيز',
                'slug' => 'sophia-rodrigues',
                'title' => 'Global Marketing Director',
                'title_ar' => 'مديرة التسويق العالمية',
                'company' => 'Global Marketing Solutions',
                'company_ar' => 'حلول التسويق العالمية',
                'image' => 'speakers/sophia-rodrigues.jpg',
                'email' => 'sophia.rodrigues@example.com',
                'phone' => '+00 123 456 789',
                'experience' => '15+ Years',
                'bio' => "Sophia Rodrigues is a Global Marketing Director with extensive experience in building brand strategies and driving market growth.\n\nShe has led successful campaigns for Fortune 500 companies and is known for her innovative approach to digital marketing.",
                'bio_ar' => "صوفيا رودريغيز هي مديرة التسويق العالمية مع خبرة واسعة في بناء استراتيجيات العلامات التجارية ودفع نمو السوق.\n\nلقد قادت حملات ناجحة لشركات فورتشن 500 وتشتهر بمنهجها المبتكر في التسويق الرقمي.",
                'twitter' => 'https://twitter.com/sophiarodrigues',
                'linkedin' => 'https://linkedin.com/in/sophiarodrigues',
                'website' => 'https://sophiarodrigues.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Jacob Jones',
                'name_ar' => 'جاكوب جونز',
                'slug' => 'jacob-jones',
                'title' => 'Lead AI Research Scientist',
                'title_ar' => 'عالم أبحاث الذكاء الاصطناعي الرئيسي',
                'company' => 'AI Innovations Lab',
                'company_ar' => 'مختبر ابتكارات الذكاء الاصطناعي',
                'image' => 'speakers/jacob-jones.jpg',
                'email' => 'jacob.jones@example.com',
                'phone' => '+00 123 456 790',
                'experience' => '12+ Years',
                'bio' => "Jacob Jones is a Lead AI Research Scientist specializing in machine learning and artificial intelligence.\n\nHis groundbreaking research has been published in top-tier journals and has influenced the development of next-generation AI systems.",
                'bio_ar' => "جاكوب جونز هو عالم أبحاث الذكاء الاصطناعي الرئيسي متخصص في التعلم الآلي والذكاء الاصطناعي.\n\nتم نشر أبحاثه الرائدة في المجلات الرائدة وأثرت على تطوير أنظمة الذكاء الاصطناعي من الجيل القادم.",
                'twitter' => 'https://twitter.com/jacobjones',
                'linkedin' => 'https://linkedin.com/in/jacobjones',
                'website' => 'https://jacobjones.ai',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Arlene McCoy',
                'name_ar' => 'أرلين مكوي',
                'slug' => 'arlene-mccoy',
                'title' => 'Innovation Strategy Expert',
                'title_ar' => 'خبيرة استراتيجية الابتكار',
                'company' => 'Strategic Innovation Group',
                'company_ar' => 'مجموعة الابتكار الاستراتيجي',
                'image' => 'speakers/arlene-mccoy.jpg',
                'email' => 'arlene.mccoy@example.com',
                'phone' => '+00 123 456 791',
                'experience' => '18+ Years',
                'bio' => "Arlene McCoy is an Innovation Strategy Expert who helps organizations transform their business models and embrace digital transformation.\n\nShe has advised numerous companies on innovation strategies and organizational change.",
                'bio_ar' => "أرلين مكوي هي خبيرة استراتيجية الابتكار التي تساعد المنظمات على تحويل نماذج أعمالها واعتماد التحول الرقمي.\n\nلقد أشارت العديد من الشركات حول استراتيجيات الابتكار والتغيير التنظيمي.",
                'twitter' => 'https://twitter.com/arlenemccoy',
                'linkedin' => 'https://linkedin.com/in/arlenemccoy',
                'website' => 'https://arlenemccoy.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Ralph Edwards',
                'name_ar' => 'رالف إدواردز',
                'slug' => 'ralph-edwards',
                'title' => 'Global Marketing Director',
                'title_ar' => 'مدير التسويق العالمي',
                'company' => 'Marketing Excellence Inc',
                'company_ar' => 'شركة التميز في التسويق',
                'image' => 'speakers/ralph-edwards.jpg',
                'email' => 'ralph.edwards@example.com',
                'phone' => '+00 123 456 792',
                'experience' => '20+ Years',
                'bio' => "Ralph Edwards brings decades of experience in global marketing and brand management.\n\nHe has successfully launched products in multiple markets and is recognized for his strategic thinking.",
                'bio_ar' => "رالف إدواردز يجلب عقودًا من الخبرة في التسويق العالمي وإدارة العلامات التجارية.\n\nلقد أطلق بنجاح منتجات في أسواق متعددة ويُعترف به لتفكيره الاستراتيجي.",
                'linkedin' => 'https://linkedin.com/in/ralphedwards',
                'website' => 'https://ralphedwards.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Kristin Watson',
                'name_ar' => 'كريستين واتسون',
                'slug' => 'kristin-watson',
                'title' => 'Global Marketing Director',
                'title_ar' => 'مديرة التسويق العالمية',
                'company' => 'Digital Marketing Pro',
                'company_ar' => 'محترف التسويق الرقمي',
                'image' => 'speakers/kristin-watson.jpg',
                'email' => 'kristin.watson@example.com',
                'phone' => '+00 123 456 793',
                'experience' => '14+ Years',
                'bio' => "Kristin Watson is a Global Marketing Director with expertise in digital transformation and customer experience.\n\nShe has helped numerous brands establish a strong online presence and engage with their audiences effectively.",
                'bio_ar' => "كريستين واتسون هي مديرة التسويق العالمية مع خبرة في التحول الرقمي وتجربة العملاء.\n\nلقد ساعدت العديد من العلامات التجارية على إنشاء وجود قوي على الإنترنت والتفاعل مع جماهيرها بفعالية.",
                'linkedin' => 'https://linkedin.com/in/kristinwatson',
                'website' => 'https://kristinwatson.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'name' => 'Michael Chen',
                'name_ar' => 'مايكل تشين',
                'slug' => 'michael-chen',
                'title' => 'Chief Technology Officer',
                'title_ar' => 'الرئيس التنفيذي للتكنولوجيا',
                'company' => 'TechVision Solutions',
                'company_ar' => 'حلول رؤية التكنولوجيا',
                'image' => 'speakers/michael-chen.jpg',
                'email' => 'michael.chen@example.com',
                'phone' => '+00 123 456 794',
                'experience' => '16+ Years',
                'bio' => "Michael Chen is a Chief Technology Officer with a passion for emerging technologies and digital innovation.\n\nHe has led technology transformations for major corporations and is an expert in cloud computing, cybersecurity, and enterprise architecture.",
                'bio_ar' => "مايكل تشين هو الرئيس التنفيذي للتكنولوجيا مع شغف بالتكنولوجيات الناشئة والابتكار الرقمي.\n\nلقد قاد تحولات تكنولوجية للشركات الكبرى وهو خبير في الحوسبة السحابية والأمن السيبراني والهندسة المعمارية المؤسسية.",
                'twitter' => 'https://twitter.com/michaelchen',
                'linkedin' => 'https://linkedin.com/in/michaelchen',
                'website' => 'https://michaelchen.tech',
                'is_featured' => true,
                'is_active' => true,
                'order' => 6,
            ],
            [
                'name' => 'Sarah Mitchell',
                'name_ar' => 'سارة ميتشل',
                'slug' => 'sarah-mitchell',
                'title' => 'Leadership Development Coach',
                'title_ar' => 'مدربة تطوير القيادة',
                'company' => 'Leadership Excellence Academy',
                'company_ar' => 'أكاديمية التميز في القيادة',
                'image' => 'speakers/sarah-mitchell.jpg',
                'email' => 'sarah.mitchell@example.com',
                'phone' => '+00 123 456 795',
                'experience' => '13+ Years',
                'bio' => "Sarah Mitchell is a Leadership Development Coach specializing in executive coaching and organizational leadership.\n\nShe has trained thousands of leaders worldwide and is known for her transformative coaching methodologies.",
                'bio_ar' => "سارة ميتشل هي مدربة تطوير القيادة متخصصة في التدريب التنفيذي والقيادة التنظيمية.\n\nلقد دربت آلاف القادة في جميع أنحاء العالم وتشتهر بمنهجيات التدريب التحويلية.",
                'linkedin' => 'https://linkedin.com/in/sarahmitchell',
                'instagram' => 'https://instagram.com/sarahmitchell',
                'website' => 'https://sarahmitchell.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'David Thompson',
                'name_ar' => 'ديفيد طومسون',
                'slug' => 'david-thompson',
                'title' => 'Financial Strategy Advisor',
                'title_ar' => 'مستشار الاستراتيجية المالية',
                'company' => 'Global Finance Partners',
                'company_ar' => 'شركاء المالية العالمية',
                'image' => 'speakers/david-thompson.jpg',
                'email' => 'david.thompson@example.com',
                'phone' => '+00 123 456 796',
                'experience' => '22+ Years',
                'bio' => "David Thompson is a Financial Strategy Advisor with extensive experience in corporate finance and investment strategy.\n\nHe has advised Fortune 500 companies on financial planning, mergers, and strategic investments.",
                'bio_ar' => "ديفيد طومسون هو مستشار الاستراتيجية المالية مع خبرة واسعة في التمويل المؤسسي واستراتيجية الاستثمار.\n\nلقد أشار شركات فورتشن 500 حول التخطيط المالي والاندماجات والاستثمارات الاستراتيجية.",
                'linkedin' => 'https://linkedin.com/in/davidthompson',
                'website' => 'https://davidthompson.com',
                'is_featured' => false,
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Emma Wilson',
                'name_ar' => 'إيما ويلسون',
                'slug' => 'emma-wilson',
                'title' => 'UX/UI Design Director',
                'title_ar' => 'مديرة تصميم تجربة المستخدم',
                'company' => 'Creative Design Studio',
                'company_ar' => 'استوديو التصميم الإبداعي',
                'image' => 'speakers/emma-wilson.jpg',
                'email' => 'emma.wilson@example.com',
                'phone' => '+00 123 456 797',
                'experience' => '11+ Years',
                'bio' => "Emma Wilson is a UX/UI Design Director known for creating intuitive and beautiful user experiences.\n\nHer designs have won multiple awards and she has worked with leading tech companies to create products that users love.",
                'bio_ar' => "إيما ويلسون هي مديرة تصميم تجربة المستخدم المعروفة بإنشاء تجارب مستخدم بديهية وجميلة.\n\nتصاميمها فازت بجوائز متعددة وقد عملت مع شركات التكنولوجيا الرائدة لإنشاء منتجات يحبها المستخدمون.",
                'twitter' => 'https://twitter.com/emmawilson',
                'linkedin' => 'https://linkedin.com/in/emmawilson',
                'instagram' => 'https://instagram.com/emmawilson',
                'website' => 'https://emmawilson.design',
                'is_featured' => true,
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'James Anderson',
                'name_ar' => 'جيمس أندرسون',
                'slug' => 'james-anderson',
                'title' => 'Data Science Lead',
                'title_ar' => 'رئيس علوم البيانات',
                'company' => 'Data Analytics Corp',
                'company_ar' => 'شركة تحليلات البيانات',
                'image' => 'speakers/james-anderson.jpg',
                'email' => 'james.anderson@example.com',
                'phone' => '+00 123 456 798',
                'experience' => '10+ Years',
                'bio' => "James Anderson is a Data Science Lead specializing in machine learning, predictive analytics, and big data solutions.\n\nHe has built data-driven systems for major enterprises and is a thought leader in the field of data science.",
                'bio_ar' => "جيمس أندرسون هو رئيس علوم البيانات متخصص في التعلم الآلي والتحليلات التنبؤية وحلول البيانات الضخمة.\n\nلقد بنى أنظمة مدفوعة بالبيانات للشركات الكبرى وهو قائد فكري في مجال علوم البيانات.",
                'twitter' => 'https://twitter.com/jamesanderson',
                'linkedin' => 'https://linkedin.com/in/jamesanderson',
                'website' => 'https://jamesanderson.data',
                'is_featured' => false,
                'is_active' => true,
                'order' => 10,
            ],
            [
                'name' => 'Lisa Park',
                'name_ar' => 'ليزا بارك',
                'slug' => 'lisa-park',
                'title' => 'Sustainability & ESG Director',
                'title_ar' => 'مديرة الاستدامة والبيئة',
                'company' => 'Green Future Initiatives',
                'company_ar' => 'مبادرات المستقبل الأخضر',
                'image' => 'speakers/lisa-park.jpg',
                'email' => 'lisa.park@example.com',
                'phone' => '+00 123 456 799',
                'experience' => '9+ Years',
                'bio' => "Lisa Park is a Sustainability & ESG Director committed to helping organizations achieve their environmental and social goals.\n\nShe has developed comprehensive sustainability strategies for multinational corporations and is a recognized expert in ESG reporting.",
                'bio_ar' => "ليزا بارك هي مديرة الاستدامة والبيئة ملتزمة بمساعدة المنظمات على تحقيق أهدافها البيئية والاجتماعية.\n\nلقد طورت استراتيجيات استدامة شاملة للشركات متعددة الجنسيات وهي خبيرة معترف بها في تقارير ESG.",
                'linkedin' => 'https://linkedin.com/in/lisapark',
                'twitter' => 'https://twitter.com/lisapark',
                'website' => 'https://lisapark.sustainability',
                'is_featured' => true,
                'is_active' => true,
                'order' => 11,
            ],
            [
                'name' => 'Robert Martinez',
                'name_ar' => 'روبرت مارتينيز',
                'slug' => 'robert-martinez',
                'title' => 'Entrepreneurship & Startup Advisor',
                'title_ar' => 'مستشار ريادة الأعمال والشركات الناشئة',
                'company' => 'Startup Ventures',
                'company_ar' => 'مشاريع الشركات الناشئة',
                'image' => 'speakers/robert-martinez.jpg',
                'email' => 'robert.martinez@example.com',
                'phone' => '+00 123 456 800',
                'experience' => '17+ Years',
                'bio' => "Robert Martinez is an Entrepreneurship & Startup Advisor who has helped launch and scale hundreds of startups.\n\nHe is a serial entrepreneur himself and has successfully exited multiple companies, making him a valuable mentor for aspiring founders.",
                'bio_ar' => "روبرت مارتينيز هو مستشار ريادة الأعمال والشركات الناشئة الذي ساعد في إطلاق وتوسيع مئات الشركات الناشئة.\n\nهو رائد أعمال متسلسل بنفسه وقد خرج بنجاح من شركات متعددة، مما يجعله مرشدًا قيمًا للمؤسسين الطموحين.",
                'twitter' => 'https://twitter.com/robertmartinez',
                'linkedin' => 'https://linkedin.com/in/robertmartinez',
                'website' => 'https://robertmartinez.ventures',
                'is_featured' => false,
                'is_active' => true,
                'order' => 12,
            ],
            [
                'name' => 'Maria Garcia',
                'name_ar' => 'ماريا غارسيا',
                'slug' => 'maria-garcia',
                'title' => 'Human Resources & Talent Development',
                'title_ar' => 'الموارد البشرية وتطوير المواهب',
                'company' => 'Talent Growth Solutions',
                'company_ar' => 'حلول نمو المواهب',
                'image' => 'speakers/maria-garcia.jpg',
                'email' => 'maria.garcia@example.com',
                'phone' => '+00 123 456 801',
                'experience' => '15+ Years',
                'bio' => "Maria Garcia is an expert in Human Resources & Talent Development with a focus on building high-performing teams.\n\nShe has transformed HR practices at numerous organizations and is known for her innovative approaches to talent acquisition and retention.",
                'bio_ar' => "ماريا غارسيا هي خبيرة في الموارد البشرية وتطوير المواهب مع التركيز على بناء فرق عالية الأداء.\n\nلقد حولت ممارسات الموارد البشرية في العديد من المنظمات وتشتهر بمناهجها المبتكرة لاكتساب المواهب والاحتفاظ بها.",
                'linkedin' => 'https://linkedin.com/in/mariagarcia',
                'website' => 'https://mariagarcia.hr',
                'is_featured' => false,
                'is_active' => true,
                'order' => 13,
            ],
            [
                'name' => 'Ahmed Hassan',
                'name_ar' => 'أحمد حسن',
                'slug' => 'ahmed-hassan',
                'title' => 'Blockchain & Cryptocurrency Expert',
                'title_ar' => 'خبير البلوك تشين والعملات المشفرة',
                'company' => 'Blockchain Innovations',
                'company_ar' => 'ابتكارات البلوك تشين',
                'image' => 'speakers/ahmed-hassan.jpg',
                'email' => 'ahmed.hassan@example.com',
                'phone' => '+00 123 456 802',
                'experience' => '8+ Years',
                'bio' => "Ahmed Hassan is a Blockchain & Cryptocurrency Expert who has been at the forefront of blockchain technology adoption.\n\nHe has consulted for major financial institutions and tech companies on implementing blockchain solutions and is a recognized authority in decentralized systems.",
                'bio_ar' => "أحمد حسن هو خبير البلوك تشين والعملات المشفرة الذي كان في طليعة اعتماد تكنولوجيا البلوك تشين.\n\nلقد استشار المؤسسات المالية الكبرى وشركات التكنولوجيا حول تنفيذ حلول البلوك تشين وهو سلطة معترف بها في الأنظمة اللامركزية.",
                'twitter' => 'https://twitter.com/ahmedhassan',
                'linkedin' => 'https://linkedin.com/in/ahmedhassan',
                'website' => 'https://ahmedhassan.blockchain',
                'is_featured' => true,
                'is_active' => true,
                'order' => 14,
            ],
        ];

        foreach ($speakers as $speakerData) {
            Speaker::updateOrCreate(
                ['slug' => $speakerData['slug']],
                $speakerData
            );
        }

        // Schedules
        $mainEvent = Event::where('slug', 'professional-skills-development-workshop')->first();
        $speakerIds = Speaker::pluck('id')->toArray();
        $eventDate = Carbon::create(2025, 3, 22);

        $schedules = [
            // Day 01
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[0],
                'title' => 'Professional Skills Development Workshop',
                'title_ar' => 'ورشة تطوير المهارات المهنية',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description_ar' => 'اطلق إمكانياتك وارتق بمهنتك مع ورشة تطوير المهارات المهنية المصممة للطلاب والمهنيين العاملين.',
                'schedule_date' => $eventDate,
                'start_time' => '09:00',
                'end_time' => '17:30',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 01',
                'day_label_ar' => 'اليوم الأول',
                'is_active' => true,
                'order' => 1,
            ],
            // Day 02
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[1],
                'title' => 'Leadership & Growth Conference',
                'title_ar' => 'مؤتمر القيادة والنمو',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description_ar' => 'انضم إلينا في مؤتمر القيادة والنمو حيث يشارك قادة الصناعة رؤاهم حول بناء فرق ناجحة.',
                'schedule_date' => $eventDate->copy()->addDay(),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 02',
                'day_label_ar' => 'اليوم الثاني',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[2],
                'title' => 'Annual Innovation Summit 2025',
                'title_ar' => 'قمة الابتكار السنوية 2025',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description_ar' => 'تجمع قمة الابتكار السنوية المبتكرين ورجال الأعمال وقادة الفكر لاستكشاف أحدث الاتجاهات.',
                'schedule_date' => $eventDate->copy()->addDay(),
                'start_time' => '11:00',
                'end_time' => '15:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 02',
                'day_label_ar' => 'اليوم الثاني',
                'is_active' => true,
                'order' => 3,
            ],
            // Day 03
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[0],
                'title' => 'Professional Skills Development Workshop',
                'title_ar' => 'ورشة تطوير المهارات المهنية',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description_ar' => 'اطلق إمكانياتك وارتق بمهنتك مع ورشة تطوير المهارات المهنية المصممة للطلاب والمهنيين العاملين.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '09:00',
                'end_time' => '17:30',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 03',
                'day_label_ar' => 'اليوم الثالث',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[1],
                'title' => 'Leadership & Growth Conference',
                'title_ar' => 'مؤتمر القيادة والنمو',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description_ar' => 'انضم إلينا في مؤتمر القيادة والنمو حيث يشارك قادة الصناعة رؤاهم حول بناء فرق ناجحة.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 03',
                'day_label_ar' => 'اليوم الثالث',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[2],
                'title' => 'Digital Marketing Masterclass',
                'title_ar' => 'فصل رئيسي في التسويق الرقمي',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description_ar' => 'أتقن فن التسويق الرقمي في هذا الفصل الرئيسي الشامل الذي يغطي تحسين محركات البحث والتسويق عبر وسائل التواصل الاجتماعي.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '08:30',
                'end_time' => '18:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 03',
                'day_label_ar' => 'اليوم الثالث',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[3],
                'title' => 'Annual Innovation Summit 2025',
                'title_ar' => 'قمة الابتكار السنوية 2025',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description_ar' => 'تجمع قمة الابتكار السنوية المبتكرين ورجال الأعمال وقادة الفكر لاستكشاف أحدث الاتجاهات.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '11:00',
                'end_time' => '15:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 03',
                'day_label_ar' => 'اليوم الثالث',
                'is_active' => true,
                'order' => 7,
            ],
        ];

        foreach ($schedules as $scheduleData) {
            Schedule::updateOrCreate(
                [
                    'event_id' => $scheduleData['event_id'],
                    'title' => $scheduleData['title'],
                    'schedule_date' => $scheduleData['schedule_date'],
                    'start_time' => $scheduleData['start_time'],
                ],
                $scheduleData
            );
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'Sophia Rodrigues',
                'name_ar' => 'صوفيا رودريغيز',
                'title' => 'Global Marketing Director',
                'title_ar' => 'مديرة التسويق العالمية',
                'content' => 'Truly outstanding service! The team exceeded our expectations with their professionalism, creativity, and quick turnaround time. Highly recommended for anyone seeking quality and reliability.',
                'content_ar' => 'خدمة رائعة حقًا! تجاوز الفريق توقعاتنا باحترافيتهم وإبداعهم وسرعة الاستجابة. موصى به بشدة لأي شخص يبحث عن الجودة والموثوقية.',
                'rating' => 5,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Ralph Edwards',
                'name_ar' => 'رالف إدواردز',
                'title' => 'Global Marketing Director',
                'title_ar' => 'مدير التسويق العالمي',
                'content' => 'Truly outstanding service! The team exceeded our expectations with their professionalism, creativity, and quick turnaround time. Highly recommended for anyone seeking quality and reliability.',
                'content_ar' => 'خدمة رائعة حقًا! تجاوز الفريق توقعاتنا باحترافيتهم وإبداعهم وسرعة الاستجابة. موصى به بشدة لأي شخص يبحث عن الجودة والموثوقية.',
                'rating' => 5,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Kristin Watson',
                'name_ar' => 'كريستين واتسون',
                'title' => 'Global Marketing Director',
                'title_ar' => 'مديرة التسويق العالمية',
                'content' => 'Truly outstanding service! The team exceeded our expectations with their professionalism, creativity, and quick turnaround time. Highly recommended for anyone seeking quality and reliability.',
                'content_ar' => 'خدمة رائعة حقًا! تجاوز الفريق توقعاتنا باحترافيتهم وإبداعهم وسرعة الاستجابة. موصى به بشدة لأي شخص يبحث عن الجودة والموثوقية.',
                'rating' => 5,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::updateOrCreate(
                ['name' => $testimonial['name'], 'title' => $testimonial['title']],
                $testimonial
            );
        }

        // Blog Posts
        $blogPosts = [
            [
                'user_id' => $admin->id,
                'title' => 'Mastering Public Speaking: Expert Tips for Confident Presentations',
                'title_ar' => 'إتقان الخطابة العامة: نصائح الخبراء للعروض الواثقة',
                'slug' => 'mastering-public-speaking-expert-tips',
                'excerpt' => 'Improve your communication skills with proven techniques used by world-class speakers to captivate and inspire audiences.',
                'excerpt_ar' => 'حسّن مهاراتك في التواصل باستخدام تقنيات مثبتة يستخدمها المتحدثون من الطراز العالمي لإبهار وإلهام الجماهير.',
                'image' => 'blog/mastering-public-speaking.jpg',
                'content' => "<p>Public speaking is one of the most valuable skills you can develop. Whether you're presenting to a small team or addressing a large conference, the ability to communicate effectively is crucial.</p>\n\n<h3>Preparation is Key</h3>\n<p>Great speakers don't just wing it. They prepare thoroughly, know their material inside and out, and practice until it becomes second nature.</p>\n\n<h3>Connect with Your Audience</h3>\n<p>The best presentations are those where the speaker connects with the audience on an emotional level. Use stories, examples, and relatable content.</p>\n\n<h3>Practice Makes Perfect</h3>\n<p>Rehearse your presentation multiple times. Practice in front of a mirror, record yourself, or present to friends for feedback.</p>",
                'content_ar' => "<p>الخطابة العامة هي واحدة من أكثر المهارات قيمة التي يمكنك تطويرها. سواء كنت تقدم عرضًا لفريق صغير أو تتحدث في مؤتمر كبير، فإن القدرة على التواصل بفعالية أمر بالغ الأهمية.</p>\n\n<h3>التحضير هو المفتاح</h3>\n<p>المتحدثون العظماء لا يقدمون عروضًا عشوائية. إنهم يستعدون بدقة، ويعرفون مادتهم من الداخل والخارج، ويمارسون حتى تصبح طبيعة ثانية.</p>\n\n<h3>تواصل مع جمهورك</h3>\n<p>أفضل العروض التقديمية هي تلك التي يتواصل فيها المتحدث مع الجمهور على المستوى العاطفي. استخدم القصص والأمثلة والمحتوى القابل للربط.</p>\n\n<h3>الممارسة تصنع الكمال</h3>\n<p>راجع عرضك التقديمي عدة مرات. مارس أمام المرآة، سجل نفسك، أو قدم لأصدقائك للحصول على ملاحظات.</p>",
                'category' => 'Skills',
                'category_ar' => 'المهارات',
                'tags' => ['Public Speaking', 'Communication', 'Presentation'],
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'Simple Self-Defense Skills Everyone Should Learn for Safety',
                'title_ar' => 'مهارات الدفاع عن النفس البسيطة التي يجب على الجميع تعلمها للسلامة',
                'slug' => 'simple-self-defense-skills',
                'excerpt' => 'Learn essential self-defense techniques that can help protect you in various situations.',
                'excerpt_ar' => 'تعلم تقنيات الدفاع عن النفس الأساسية التي يمكن أن تساعد في حمايتك في مواقف مختلفة.',
                'image' => 'blog/self-defense-skills.jpg',
                'content' => "<p>Self-defense is not about being aggressive—it's about being prepared and confident. Here are some fundamental skills everyone should know.</p>\n\n<h3>Awareness is Your First Defense</h3>\n<p>Being aware of your surroundings is the most important self-defense skill. Pay attention to what's happening around you.</p>\n\n<h3>Basic Techniques</h3>\n<p>Learn basic strikes, blocks, and escape techniques. These don't require years of training but can be highly effective.</p>\n\n<h3>Confidence and Assertiveness</h3>\n<p>Projecting confidence can often deter potential threats. Stand tall, make eye contact, and be assertive when necessary.</p>",
                'content_ar' => "<p>الدفاع عن النفس ليس عن كونك عدوانيًا - بل عن كونك مستعدًا وواثقًا. إليك بعض المهارات الأساسية التي يجب على الجميع معرفتها.</p>\n\n<h3>الوعي هو دفاعك الأول</h3>\n<p>كونك مدركًا لمحيطك هو أهم مهارة دفاع عن النفس. انتبه لما يحدث حولك.</p>\n\n<h3>التقنيات الأساسية</h3>\n<p>تعلم تقنيات الضرب والحجب والهروب الأساسية. هذه لا تتطلب سنوات من التدريب ولكن يمكن أن تكون فعالة للغاية.</p>\n\n<h3>الثقة والحزم</h3>\n<p>إظهار الثقة يمكن أن يردع التهديدات المحتملة. قف منتصبًا، واتصل بالعين، وكن حازمًا عند الضرورة.</p>",
                'category' => 'Safety',
                'category_ar' => 'السلامة',
                'tags' => ['Self-Defense', 'Safety', 'Skills'],
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'The Power of Networking: Building Connections That Last',
                'title_ar' => 'قوة التواصل: بناء علاقات تدوم',
                'slug' => 'power-of-networking-building-connections',
                'excerpt' => 'Discover how to build meaningful professional relationships that can transform your career.',
                'excerpt_ar' => 'اكتشف كيفية بناء علاقات مهنية ذات معنى يمكن أن تحول مسيرتك المهنية.',
                'image' => 'blog/networking-power.jpg',
                'content' => "<p>Networking is more than just exchanging business cards. It's about building genuine relationships that can support your career growth.</p>\n\n<h3>Quality Over Quantity</h3>\n<p>It's better to have a few deep, meaningful connections than hundreds of superficial ones. Focus on building genuine relationships.</p>\n\n<h3>Give Before You Get</h3>\n<p>The best networkers give value first. Offer help, share knowledge, and support others before asking for anything in return.</p>\n\n<h3>Follow Up and Stay Connected</h3>\n<p>After meeting someone, follow up within 48 hours. Stay in touch regularly, not just when you need something.</p>",
                'content_ar' => "<p>التواصل المهني هو أكثر من مجرد تبادل بطاقات العمل. يتعلق الأمر ببناء علاقات حقيقية يمكن أن تدعم نمو مسيرتك المهنية.</p>\n\n<h3>الجودة على الكمية</h3>\n<p>من الأفضل أن يكون لديك بعض الاتصالات العميقة والهادفة بدلاً من مئات الاتصالات السطحية. ركز على بناء علاقات حقيقية.</p>\n\n<h3>أعطِ قبل أن تأخذ</h3>\n<p>أفضل من يمارسون التواصل المهني يعطون القيمة أولاً. قدم المساعدة، شارك المعرفة، وادعم الآخرين قبل أن تطلب أي شيء في المقابل.</p>\n\n<h3>تابع وابق على اتصال</h3>\n<p>بعد لقاء شخص ما، تابع خلال 48 ساعة. ابق على اتصال بانتظام، وليس فقط عندما تحتاج إلى شيء.</p>",
                'category' => 'Career',
                'category_ar' => 'المسيرة المهنية',
                'tags' => ['Networking', 'Career', 'Relationships'],
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($blogPosts as $post) {
            BlogPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }

        // Sponsors - Update these with actual sponsor logo paths from template
        $sponsors = [
            ['name' => 'TechCorp', 'logo' => 'sponsors/sponsor-1.png', 'website' => 'https://techcorp.com', 'tier' => 'platinum', 'is_active' => true, 'order' => 1],
            ['name' => 'InnovateLabs', 'logo' => 'sponsors/sponsor-2.png', 'website' => 'https://innovatelabs.com', 'tier' => 'platinum', 'is_active' => true, 'order' => 2],
            ['name' => 'CloudScale', 'logo' => 'sponsors/sponsor-3.png', 'website' => 'https://cloudscale.com', 'tier' => 'gold', 'is_active' => true, 'order' => 3],
            ['name' => 'DataDriven', 'logo' => 'sponsors/sponsor-4.png', 'website' => 'https://datadriven.com', 'tier' => 'gold', 'is_active' => true, 'order' => 4],
            ['name' => 'StartupHub', 'logo' => 'sponsors/sponsor-5.png', 'website' => 'https://startuphub.com', 'tier' => 'silver', 'is_active' => true, 'order' => 5],
            ['name' => 'DevTools', 'logo' => 'sponsors/sponsor-6.png', 'website' => 'https://devtools.com', 'tier' => 'silver', 'is_active' => true, 'order' => 6],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::updateOrCreate(
                ['name' => $sponsor['name']],
                $sponsor
            );
        }

        // FAQs
        $faqs = [
            [
                'question' => 'How does the complete event register process actually work?',
                'question_ar' => 'كيف تعمل عملية التسجيل الكاملة للحدث فعليًا؟',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'answer_ar' => 'تم تصميم حدثنا بجدولة مرنة، مما يسمح لك بالتنقل بين القاعات، واختيار الجلسات التي تهمك أكثر، وتخصيص تجربة التعلم الخاصة بك طوال اليوم.',
                'category' => 'Registration',
                'category_ar' => 'التسجيل',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => 'Where is the main event venue located precisely?',
                'question_ar' => 'أين يقع مكان الحدث الرئيسي بالضبط؟',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'answer_ar' => 'تم تصميم حدثنا بجدولة مرنة، مما يسمح لك بالتنقل بين القاعات، واختيار الجلسات التي تهمك أكثر، وتخصيص تجربة التعلم الخاصة بك طوال اليوم.',
                'category' => 'Venue',
                'category_ar' => 'المكان',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'question' => 'Can attendees freely switch between sessions and tracks?',
                'question_ar' => 'هل يمكن للمشاركين التبديل بحرية بين الجلسات والمسارات؟',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'answer_ar' => 'تم تصميم حدثنا بجدولة مرنة، مما يسمح لك بالتنقل بين القاعات، واختيار الجلسات التي تهمك أكثر، وتخصيص تجربة التعلم الخاصة بك طوال اليوم.',
                'category' => 'Sessions',
                'category_ar' => 'الجلسات',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'question' => 'Does the event provide virtual participation options online?',
                'question_ar' => 'هل يوفر الحدث خيارات المشاركة الافتراضية عبر الإنترنت؟',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'answer_ar' => 'تم تصميم حدثنا بجدولة مرنة، مما يسمح لك بالتنقل بين القاعات، واختيار الجلسات التي تهمك أكثر، وتخصيص تجربة التعلم الخاصة بك طوال اليوم.',
                'category' => 'Virtual',
                'category_ar' => 'افتراضي',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'question' => 'What is the event refund and cancellation policy?',
                'question_ar' => 'ما هي سياسة استرداد الأموال وإلغاء الحدث؟',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'answer_ar' => 'تم تصميم حدثنا بجدولة مرنة، مما يسمح لك بالتنقل بين القاعات، واختيار الجلسات التي تهمك أكثر، وتخصيص تجربة التعلم الخاصة بك طوال اليوم.',
                'category' => 'Refunds',
                'category_ar' => 'الاسترداد',
                'is_active' => true,
                'order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }

        // Galleries - Update these with actual gallery image paths from template
        $galleries = [
            ['title' => 'Opening Ceremony', 'image' => 'galleries/gallery-1.jpg', 'type' => 'image', 'is_active' => true, 'order' => 1],
            ['title' => 'Keynote Session', 'image' => 'galleries/gallery-2.jpg', 'type' => 'image', 'is_active' => true, 'order' => 2],
            ['title' => 'Networking Event', 'image' => 'galleries/gallery-3.jpg', 'type' => 'image', 'is_active' => true, 'order' => 3],
            ['title' => 'Workshop Session', 'image' => 'galleries/gallery-4.jpg', 'type' => 'image', 'is_active' => true, 'order' => 4],
            ['title' => 'Panel Discussion', 'image' => 'galleries/gallery-5.jpg', 'type' => 'image', 'is_active' => true, 'order' => 5],
            ['title' => 'Awards Ceremony', 'image' => 'galleries/gallery-6.jpg', 'type' => 'image', 'is_active' => true, 'order' => 6],
        ];

        foreach ($galleries as $gallery) {
            Gallery::updateOrCreate(
                ['title' => $gallery['title']],
                $gallery
            );
        }
    }
}
