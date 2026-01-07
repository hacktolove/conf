<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Schedule;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Models\News;
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
            // Day 04
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[0] ?? null,
                'title' => 'Technology & Innovation Forum',
                'title_ar' => 'منتدى التكنولوجيا والابتكار',
                'description' => 'Explore the latest technological innovations and their impact on business and society in this comprehensive forum.',
                'description_ar' => 'استكشف أحدث الابتكارات التكنولوجية وتأثيرها على الأعمال والمجتمع في هذا المنتدى الشامل.',
                'schedule_date' => $eventDate->copy()->addDays(3),
                'start_time' => '09:00',
                'end_time' => '17:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 04',
                'day_label_ar' => 'اليوم الرابع',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[1] ?? null,
                'title' => 'Business Strategy Workshop',
                'title_ar' => 'ورشة استراتيجية الأعمال',
                'description' => 'Learn advanced business strategies and frameworks to drive growth and competitive advantage.',
                'description_ar' => 'تعلم استراتيجيات الأعمال المتقدمة والأطر لدفع النمو والميزة التنافسية.',
                'schedule_date' => $eventDate->copy()->addDays(3),
                'start_time' => '14:00',
                'end_time' => '18:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 04',
                'day_label_ar' => 'اليوم الرابع',
                'is_active' => true,
                'order' => 9,
            ],
            // Day 05
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[2] ?? null,
                'title' => 'Data Analytics & AI Conference',
                'title_ar' => 'مؤتمر تحليل البيانات والذكاء الاصطناعي',
                'description' => 'Discover how data analytics and artificial intelligence are transforming industries and creating new opportunities.',
                'description_ar' => 'اكتشف كيف يحول تحليل البيانات والذكاء الاصطناعي الصناعات ويخلق فرصًا جديدة.',
                'schedule_date' => $eventDate->copy()->addDays(4),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 05',
                'day_label_ar' => 'اليوم الخامس',
                'is_active' => true,
                'order' => 10,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[3] ?? null,
                'title' => 'Networking & Collaboration Summit',
                'title_ar' => 'قمة التواصل والتعاون',
                'description' => 'Build meaningful connections and explore collaboration opportunities with industry leaders and peers.',
                'description_ar' => 'بناء علاقات ذات مغزى واستكشف فرص التعاون مع قادة الصناعة والأقران.',
                'schedule_date' => $eventDate->copy()->addDays(4),
                'start_time' => '13:00',
                'end_time' => '17:30',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 05',
                'day_label_ar' => 'اليوم الخامس',
                'is_active' => true,
                'order' => 11,
            ],
            // Day 06
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[0] ?? null,
                'title' => 'Entrepreneurship & Startups Forum',
                'title_ar' => 'منتدى ريادة الأعمال والشركات الناشئة',
                'description' => 'Learn from successful entrepreneurs and discover the keys to building and scaling innovative startups.',
                'description_ar' => 'تعلم من رواد الأعمال الناجحين واكتشف مفاتيح بناء وتوسيع الشركات الناشئة المبتكرة.',
                'schedule_date' => $eventDate->copy()->addDays(5),
                'start_time' => '09:30',
                'end_time' => '16:30',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 06',
                'day_label_ar' => 'اليوم السادس',
                'is_active' => true,
                'order' => 12,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[1] ?? null,
                'title' => 'Future of Work Symposium',
                'title_ar' => 'ندوة مستقبل العمل',
                'description' => 'Explore emerging trends in the workplace and how to adapt to the changing nature of work.',
                'description_ar' => 'استكشف الاتجاهات الناشئة في مكان العمل وكيفية التكيف مع الطبيعة المتغيرة للعمل.',
                'schedule_date' => $eventDate->copy()->addDays(5),
                'start_time' => '11:00',
                'end_time' => '15:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 06',
                'day_label_ar' => 'اليوم السادس',
                'is_active' => true,
                'order' => 13,
            ],
            // Day 07
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[2] ?? null,
                'title' => 'Sustainability & Green Business Conference',
                'title_ar' => 'مؤتمر الاستدامة والأعمال الخضراء',
                'description' => 'Learn how to build sustainable business practices and contribute to environmental conservation.',
                'description_ar' => 'تعلم كيفية بناء ممارسات الأعمال المستدامة والمساهمة في الحفاظ على البيئة.',
                'schedule_date' => $eventDate->copy()->addDays(6),
                'start_time' => '10:00',
                'end_time' => '17:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 07',
                'day_label_ar' => 'اليوم السابع',
                'is_active' => true,
                'order' => 14,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[3] ?? null,
                'title' => 'Closing Ceremony & Awards',
                'title_ar' => 'حفل الختام والجوائز',
                'description' => 'Join us for the closing ceremony where we celebrate achievements and recognize outstanding contributions.',
                'description_ar' => 'انضم إلينا في حفل الختام حيث نحتفل بالإنجازات ونعترف بالمساهمات المتميزة.',
                'schedule_date' => $eventDate->copy()->addDays(6),
                'start_time' => '18:00',
                'end_time' => '20:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'venue_ar' => 'الشارع، المبنى 12 القطاع 4، مدينة إيبسوم',
                'day_label' => 'Day 07',
                'day_label_ar' => 'اليوم السابع',
                'is_active' => true,
                'order' => 15,
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

        // News
        $news = [
            [
                'title' => 'Conference Registration Now Open - Early Bird Discount Available',
                'title_ar' => 'التسجيل في المؤتمر مفتوح الآن - خصم الطائر المبكر متاح',
                'slug' => 'conference-registration-now-open',
                'body' => "<p>We're excited to announce that registration for the upcoming conference is now open! Don't miss out on our early bird discount available for the first 100 registrations.</p>\n\n<p>Join us for an incredible experience featuring world-class speakers, innovative workshops, and networking opportunities that will transform your professional journey.</p>\n\n<h3>What's Included:</h3>\n<ul>\n<li>Access to all conference sessions</li>\n<li>Networking events and social gatherings</li>\n<li>Workshop materials and resources</li>\n<li>Certificate of participation</li>\n</ul>",
                'body_ar' => "<p>يسعدنا أن نعلن أن التسجيل في المؤتمر القادم مفتوح الآن! لا تفوت خصم الطائر المبكر المتاح لأول 100 تسجيل.</p>\n\n<p>انضم إلينا لتجربة رائعة تضم متحدثين من الطراز العالمي وورش عمل مبتكرة وفرص التواصل التي ستحول رحلتك المهنية.</p>\n\n<h3>ما المدرج:</h3>\n<ul>\n<li>الوصول إلى جميع جلسات المؤتمر</li>\n<li>فعاليات التواصل والتجمعات الاجتماعية</li>\n<li>مواد وموارد ورش العمل</li>\n<li>شهادة المشاركة</li>\n</ul>",
                'date' => Carbon::now()->subDays(2),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'Keynote Speaker Announcement: Industry Leaders to Share Insights',
                'title_ar' => 'إعلان المتحدث الرئيسي: قادة الصناعة يشاركون رؤاهم',
                'slug' => 'keynote-speaker-announcement',
                'body' => "<p>We're thrilled to announce our lineup of keynote speakers for this year's conference. These industry leaders will share their insights, experiences, and vision for the future.</p>\n\n<p>Our keynote speakers include:</p>\n<ul>\n<li>Global Marketing Directors from Fortune 500 companies</li>\n<li>AI Research Scientists leading innovation</li>\n<li>Entrepreneurship advisors with successful exits</li>\n<li>Sustainability experts shaping green business practices</li>\n</ul>\n\n<p>Don't miss this opportunity to learn from the best in the industry.</p>",
                'body_ar' => "<p>يسعدنا أن نعلن عن قائمة المتحدثين الرئيسيين لمؤتمر هذا العام. سيتشارك هؤلاء القادة في الصناعة رؤاهم وخبراتهم ورؤيتهم للمستقبل.</p>\n\n<p>يتضمن المتحدثون الرئيسيون لدينا:</p>\n<ul>\n<li>مديري التسويق العالميين من شركات فورتشن 500</li>\n<li>علماء أبحاث الذكاء الاصطناعي الذين يقودون الابتكار</li>\n<li>مستشاري ريادة الأعمال مع خروج ناجح</li>\n<li>خبراء الاستدامة الذين يشكلون ممارسات الأعمال الخضراء</li>\n</ul>\n\n<p>لا تفوت هذه الفرصة للتعلم من الأفضل في الصناعة.</p>",
                'date' => Carbon::now()->subDays(5),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Workshop Schedule Released - Register for Your Preferred Sessions',
                'title_ar' => 'إصدار جدول ورش العمل - سجل في جلساتك المفضلة',
                'slug' => 'workshop-schedule-released',
                'body' => "<p>The complete workshop schedule has been released! We have an exciting lineup of hands-on workshops covering various topics including:</p>\n\n<h3>Featured Workshops:</h3>\n<ul>\n<li>Digital Marketing Masterclass</li>\n<li>Leadership Development Intensive</li>\n<li>Data Analytics & AI Applications</li>\n<li>Entrepreneurship & Startup Strategies</li>\n<li>UX/UI Design Fundamentals</li>\n</ul>\n\n<p>Spaces are limited, so be sure to register early to secure your spot in your preferred workshops.</p>",
                'body_ar' => "<p>تم إصدار جدول ورش العمل الكامل! لدينا قائمة مثيرة من ورش العمل العملية التي تغطي مواضيع مختلفة بما في ذلك:</p>\n\n<h3>ورش العمل المميزة:</h3>\n<ul>\n<li>فصل رئيسي في التسويق الرقمي</li>\n<li>دورة مكثفة لتطوير القيادة</li>\n<li>تحليل البيانات وتطبيقات الذكاء الاصطناعي</li>\n<li>ريادة الأعمال واستراتيجيات الشركات الناشئة</li>\n<li>أساسيات تصميم تجربة المستخدم</li>\n</ul>\n\n<p>الأماكن محدودة، لذا تأكد من التسجيل مبكرًا لتأمين مكانك في ورش العمل المفضلة لديك.</p>",
                'date' => Carbon::now()->subDays(7),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => 'Networking Events Announced - Connect with Industry Professionals',
                'title_ar' => 'إعلان فعاليات التواصل - تواصل مع المهنيين في الصناعة',
                'slug' => 'networking-events-announced',
                'body' => "<p>We're excited to announce a series of networking events designed to help you connect with industry professionals, potential collaborators, and like-minded individuals.</p>\n\n<p>Our networking program includes:</p>\n<ul>\n<li>Welcome Reception on Day 1</li>\n<li>Industry-specific networking sessions</li>\n<li>Speed networking events</li>\n<li>Closing cocktail party</li>\n</ul>\n\n<p>These events provide the perfect opportunity to expand your professional network and build lasting relationships.</p>",
                'body_ar' => "<p>يسعدنا أن نعلن عن سلسلة من فعاليات التواصل المصممة لمساعدتك على التواصل مع المهنيين في الصناعة والمتعاونين المحتملين والأفراد ذوي التفكير المماثل.</p>\n\n<p>يتضمن برنامج التواصل لدينا:</p>\n<ul>\n<li>استقبال الترحيب في اليوم الأول</li>\n<li>جلسات التواصل الخاصة بالصناعة</li>\n<li>فعاليات التواصل السريع</li>\n<li>حفلة كوكتيل الختام</li>\n</ul>\n\n<p>توفر هذه الفعاليات الفرصة المثالية لتوسيع شبكتك المهنية وبناء علاقات دائمة.</p>",
                'date' => Carbon::now()->subDays(10),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => 'Venue and Accommodation Information Now Available',
                'title_ar' => 'معلومات المكان والإقامة متاحة الآن',
                'slug' => 'venue-accommodation-information',
                'body' => "<p>We've released detailed information about the conference venue and recommended accommodation options for attendees.</p>\n\n<h3>Conference Venue:</h3>\n<p>The event will be held at our state-of-the-art conference center located in the heart of the city, easily accessible by public transportation.</p>\n\n<h3>Recommended Hotels:</h3>\n<p>We've partnered with several hotels near the venue offering special rates for conference attendees. Book early to secure the best rates!</p>\n\n<p>For more details, visit our accommodation page or contact our support team.</p>",
                'body_ar' => "<p>لقد أصدرنا معلومات مفصلة عن مكان المؤتمر وخيارات الإقامة الموصى بها للمشاركين.</p>\n\n<h3>مكان المؤتمر:</h3>\n<p>سيتم عقد الحدث في مركز المؤتمرات الحديث لدينا الموجود في قلب المدينة، ويمكن الوصول إليه بسهولة عبر وسائل النقل العام.</p>\n\n<h3>الفنادق الموصى بها:</h3>\n<p>لقد شركنا مع عدة فنادق بالقرب من المكان تقدم أسعارًا خاصة للمشاركين في المؤتمر. احجز مبكرًا لتأمين أفضل الأسعار!</p>\n\n<p>لمزيد من التفاصيل، قم بزيارة صفحة الإقامة الخاصة بنا أو اتصل بفريق الدعم.</p>",
                'date' => Carbon::now()->subDays(12),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'Call for Volunteers - Join Our Amazing Team',
                'title_ar' => 'دعوة للمتطوعين - انضم إلى فريقنا الرائع',
                'slug' => 'call-for-volunteers',
                'body' => "<p>We're looking for enthusiastic volunteers to help make this conference a success! As a volunteer, you'll have the opportunity to:</p>\n\n<ul>\n<li>Network with industry leaders and speakers</li>\n<li>Gain valuable event management experience</li>\n<li>Attend sessions when not on duty</li>\n<li>Receive a certificate of appreciation</li>\n<li>Enjoy meals and refreshments during the event</li>\n</ul>\n\n<p>If you're interested in volunteering, please fill out our volunteer application form. We'd love to have you on our team!</p>",
                'body_ar' => "<p>نبحث عن متطوعين متحمسين للمساعدة في جعل هذا المؤتمر نجاحًا! كمتطوع، ستتاح لك الفرصة ل:</p>\n\n<ul>\n<li>التواصل مع قادة الصناعة والمتحدثين</li>\n<li>اكتساب خبرة قيمة في إدارة الأحداث</li>\n<li>حضور الجلسات عندما لا تكون في الخدمة</li>\n<li>الحصول على شهادة تقدير</li>\n<li>الاستمتاع بالوجبات والمرطبات أثناء الحدث</li>\n</ul>\n\n<p>إذا كنت مهتمًا بالتطوع، يرجى ملء نموذج طلب المتطوعين. نحب أن يكون لديك في فريقنا!</p>",
                'date' => Carbon::now()->subDays(15),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(15),
            ],
            [
                'title' => 'Special Discount for Students and Early Career Professionals',
                'title_ar' => 'خصم خاص للطلاب والمهنيين في بداية مسيرتهم',
                'slug' => 'student-discount-announced',
                'body' => "<p>We're offering special discounted rates for students and early career professionals to make the conference more accessible.</p>\n\n<h3>Eligibility:</h3>\n<ul>\n<li>Full-time students with valid student ID</li>\n<li>Professionals with less than 3 years of experience</li>\n</ul>\n\n<h3>Benefits:</h3>\n<p>Student and early career tickets include all the same benefits as regular tickets at a significantly reduced price. This is a great opportunity to invest in your professional development!</p>\n\n<p>To claim your discount, use the code STUDENT2025 during registration.</p>",
                'body_ar' => "<p>نقدم أسعارًا مخفضة خاصة للطلاب والمهنيين في بداية مسيرتهم لجعل المؤتمر أكثر سهولة.</p>\n\n<h3>الأهلية:</h3>\n<ul>\n<li>الطلاب بدوام كامل مع هوية طالب صالحة</li>\n<li>المهنيون بأقل من 3 سنوات من الخبرة</li>\n</ul>\n\n<h3>الفوائد:</h3>\n<p>تذاكر الطلاب والمهنيين في بداية مسيرتهم تشمل جميع نفس الفوائد مثل التذاكر العادية بسعر مخفض بشكل كبير. هذه فرصة رائعة للاستثمار في تطويرك المهني!</p>\n\n<p>للمطالبة بخصمك، استخدم الرمز STUDENT2025 أثناء التسجيل.</p>",
                'date' => Carbon::now()->subDays(18),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(18),
            ],
            [
                'title' => 'Conference Mobile App Now Available for Download',
                'title_ar' => 'تطبيق المؤتمر المحمول متاح الآن للتحميل',
                'slug' => 'conference-mobile-app-available',
                'body' => "<p>Download our official conference mobile app to enhance your conference experience!</p>\n\n<h3>App Features:</h3>\n<ul>\n<li>Personalized schedule builder</li>\n<li>Real-time session updates and notifications</li>\n<li>Interactive venue maps</li>\n<li>Networking features to connect with other attendees</li>\n<li>Speaker profiles and session materials</li>\n<li>QR code check-in</li>\n</ul>\n\n<p>The app is available for both iOS and Android devices. Download it today and start planning your conference experience!</p>",
                'body_ar' => "<p>قم بتنزيل تطبيق المؤتمر المحمول الرسمي لدينا لتعزيز تجربة المؤتمر الخاصة بك!</p>\n\n<h3>ميزات التطبيق:</h3>\n<ul>\n<li>منشئ جدول مخصص</li>\n<li>تحديثات الجلسات والإشعارات في الوقت الفعلي</li>\n<li>خرائط المكان التفاعلية</li>\n<li>ميزات التواصل للتواصل مع المشاركين الآخرين</li>\n<li>ملفات تعريف المتحدثين ومواد الجلسات</li>\n<li>تسجيل الدخول برمز QR</li>\n</ul>\n\n<p>التطبيق متاح لأجهزة iOS و Android. قم بتنزيله اليوم وابدأ في التخطيط لتجربة المؤتمر الخاصة بك!</p>",
                'date' => Carbon::now()->subDays(20),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(20),
            ],
        ];

        foreach ($news as $newsItem) {
            News::updateOrCreate(
                ['slug' => $newsItem['slug']],
                $newsItem
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
