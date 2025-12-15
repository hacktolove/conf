<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Schedule;
use App\Models\PricingPlan;
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
            'site_name' => 'Evenza',
            'site_tagline' => 'Ideas that spark change.',
            'site_description' => 'Experience a powerful gathering of visionaries, creators, and industry experts united by one goal—exchanging ideas that spark growth, innovation, and meaningful change.',
            'contact_email' => 'support@domainname.com',
            'contact_phone' => '+00 123 456 789',
            'contact_address' => '45/2 Central Business Innovation Near International Trade Tower',
            'social_facebook' => 'https://facebook.com/evenza',
            'social_twitter' => 'https://twitter.com/evenza',
            'social_instagram' => 'https://instagram.com/evenza',
            'social_linkedin' => 'https://linkedin.com/company/evenza',
            'social_youtube' => 'https://youtube.com/evenza',
            'countdown_date' => now()->addMonths(3)->format('Y-m-d H:i:s'),
            'mission' => 'Our mission is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.',
            'vision' => 'Our vision is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.',
            'goal' => 'Our goal is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // Hero Slides
        $heroSlides = [
            [
                'title' => 'Connecting Minds to Shape Tomorrow\'s Big Ideas',
                'subtitle' => 'Ideas that spark change.',
                'description' => 'Experience a powerful gathering of visionaries, creators, and industry experts united by one goal—exchanging ideas that spark growth, innovation, and meaningful change.',
                'image' => 'hero-slides/hero-1.jpg',
                'button_text' => 'Explore Schedule',
                'button_link' => '/schedule',
                'button_text_2' => 'Watch Video',
                'button_link_2' => '#',
                'is_active' => true,
                'order' => 1,
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
                'slug' => 'professional-skills-development-workshop',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description' => "Unlock your potential and elevate your career with our Professional Skills Development Workshop designed for students and working professionals.\n\nThis comprehensive workshop covers essential skills including communication, leadership, time management, and professional development strategies.",
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
                'event_date' => Carbon::create(2025, 3, 22),
                'start_time' => '09:00',
                'end_time' => '17:30',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Leadership & Growth Conference',
                'slug' => 'leadership-growth-conference',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description' => "Join us for the Leadership & Growth Conference where industry leaders share insights on building successful teams and driving organizational growth.",
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
                'event_date' => Carbon::create(2025, 5, 5),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Digital Marketing Masterclass',
                'slug' => 'digital-marketing-masterclass',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description' => "Master the art of digital marketing in this comprehensive masterclass covering SEO, social media marketing, content strategy, and analytics.",
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
                'event_date' => Carbon::create(2025, 6, 20),
                'start_time' => '08:30',
                'end_time' => '18:00',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Annual Innovation Summit 2025',
                'slug' => 'annual-innovation-summit-2025',
                'short_description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'description' => "The Annual Innovation Summit brings together innovators, entrepreneurs, and thought leaders to explore the latest trends and technologies shaping our future.",
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'address' => 'Street, Block 12 Sector 4, Ipsum City',
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
                'slug' => 'sophia-rodrigues',
                'title' => 'Global Marketing Director',
                'company' => 'Global Marketing Solutions',
                'image' => 'speakers/sophia-rodrigues.jpg',
                'email' => 'sophia.rodrigues@example.com',
                'phone' => '+00 123 456 789',
                'experience' => '15+ Years',
                'bio' => "Sophia Rodrigues is a Global Marketing Director with extensive experience in building brand strategies and driving market growth.\n\nShe has led successful campaigns for Fortune 500 companies and is known for her innovative approach to digital marketing.",
                'twitter' => 'https://twitter.com/sophiarodrigues',
                'linkedin' => 'https://linkedin.com/in/sophiarodrigues',
                'website' => 'https://sophiarodrigues.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Jacob Jones',
                'slug' => 'jacob-jones',
                'title' => 'Lead AI Research Scientist',
                'company' => 'AI Innovations Lab',
                'image' => 'speakers/jacob-jones.jpg',
                'email' => 'jacob.jones@example.com',
                'phone' => '+00 123 456 790',
                'experience' => '12+ Years',
                'bio' => "Jacob Jones is a Lead AI Research Scientist specializing in machine learning and artificial intelligence.\n\nHis groundbreaking research has been published in top-tier journals and has influenced the development of next-generation AI systems.",
                'twitter' => 'https://twitter.com/jacobjones',
                'linkedin' => 'https://linkedin.com/in/jacobjones',
                'website' => 'https://jacobjones.ai',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Arlene McCoy',
                'slug' => 'arlene-mccoy',
                'title' => 'Innovation Strategy Expert',
                'company' => 'Strategic Innovation Group',
                'image' => 'speakers/arlene-mccoy.jpg',
                'email' => 'arlene.mccoy@example.com',
                'phone' => '+00 123 456 791',
                'experience' => '18+ Years',
                'bio' => "Arlene McCoy is an Innovation Strategy Expert who helps organizations transform their business models and embrace digital transformation.\n\nShe has advised numerous companies on innovation strategies and organizational change.",
                'twitter' => 'https://twitter.com/arlenemccoy',
                'linkedin' => 'https://linkedin.com/in/arlenemccoy',
                'website' => 'https://arlenemccoy.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'name' => 'Ralph Edwards',
                'slug' => 'ralph-edwards',
                'title' => 'Global Marketing Director',
                'company' => 'Marketing Excellence Inc',
                'image' => 'speakers/ralph-edwards.jpg',
                'email' => 'ralph.edwards@example.com',
                'phone' => '+00 123 456 792',
                'experience' => '20+ Years',
                'bio' => "Ralph Edwards brings decades of experience in global marketing and brand management.\n\nHe has successfully launched products in multiple markets and is recognized for his strategic thinking.",
                'linkedin' => 'https://linkedin.com/in/ralphedwards',
                'website' => 'https://ralphedwards.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'name' => 'Kristin Watson',
                'slug' => 'kristin-watson',
                'title' => 'Global Marketing Director',
                'company' => 'Digital Marketing Pro',
                'image' => 'speakers/kristin-watson.jpg',
                'email' => 'kristin.watson@example.com',
                'phone' => '+00 123 456 793',
                'experience' => '14+ Years',
                'bio' => "Kristin Watson is a Global Marketing Director with expertise in digital transformation and customer experience.\n\nShe has helped numerous brands establish a strong online presence and engage with their audiences effectively.",
                'linkedin' => 'https://linkedin.com/in/kristinwatson',
                'website' => 'https://kristinwatson.com',
                'is_featured' => true,
                'is_active' => true,
                'order' => 5,
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
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'schedule_date' => $eventDate,
                'start_time' => '09:00',
                'end_time' => '17:30',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'day_label' => 'Day 01',
                'is_active' => true,
                'order' => 1,
            ],
            // Day 02
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[1],
                'title' => 'Leadership & Growth Conference',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'schedule_date' => $eventDate->copy()->addDay(),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'day_label' => 'Day 02',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[2],
                'title' => 'Annual Innovation Summit 2025',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'schedule_date' => $eventDate->copy()->addDay(),
                'start_time' => '11:00',
                'end_time' => '15:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'day_label' => 'Day 02',
                'is_active' => true,
                'order' => 3,
            ],
            // Day 03
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[0],
                'title' => 'Professional Skills Development Workshop',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '09:00',
                'end_time' => '17:30',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'day_label' => 'Day 03',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[1],
                'title' => 'Leadership & Growth Conference',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '10:00',
                'end_time' => '16:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'day_label' => 'Day 03',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[2],
                'title' => 'Digital Marketing Masterclass',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '08:30',
                'end_time' => '18:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'day_label' => 'Day 03',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'event_id' => $mainEvent->id,
                'speaker_id' => $speakerIds[3],
                'title' => 'Annual Innovation Summit 2025',
                'description' => 'Unlock your potential and elevate your career with our Professional Skills Development designed students, working professionals.',
                'schedule_date' => $eventDate->copy()->addDays(2),
                'start_time' => '11:00',
                'end_time' => '15:00',
                'venue' => 'Street, Block 12 Sector 4, Ipsum City',
                'day_label' => 'Day 03',
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

        // Pricing Plans
        $pricingPlans = [
            [
                'name' => 'Basic Package',
                'price' => 49,
                'currency' => '$',
                'duration' => 'One-Time',
                'description' => 'Perfect for first-time attend',
                'features' => ['Entry to all standard sessions', 'Reserved seating in select session', 'Meet & greet with speakers', 'Premium networking lounge'],
                'button_text' => 'Get Standard Pass',
                'button_link' => '#',
                'is_featured' => false,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Standard Pass',
                'price' => 59,
                'currency' => '$',
                'duration' => 'One-Time',
                'description' => 'Perfect for first-time attend',
                'features' => ['Entry to all standard sessions', 'Reserved seating in select session', 'Meet & greet with speakers', 'Premium networking lounge'],
                'button_text' => 'Get Standard Pass',
                'button_link' => '#',
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Premium Pass',
                'price' => 69,
                'currency' => '$',
                'duration' => 'One-Time',
                'description' => 'Perfect for first-time attend',
                'features' => ['Entry to all standard sessions', 'Reserved seating in select session', 'Meet & greet with speakers', 'Premium networking lounge'],
                'button_text' => 'Get Standard Pass',
                'button_link' => '#',
                'is_featured' => false,
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($pricingPlans as $plan) {
            PricingPlan::updateOrCreate(
                ['name' => $plan['name']],
                $plan
            );
        }

        // Testimonials
        $testimonials = [
            [
                'name' => 'Sophia Rodrigues',
                'title' => 'Global Marketing Director',
                'content' => 'Truly outstanding service! The team exceeded our expectations with their professionalism, creativity, and quick turnaround time. Highly recommended for anyone seeking quality and reliability.',
                'rating' => 5,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'name' => 'Ralph Edwards',
                'title' => 'Global Marketing Director',
                'content' => 'Truly outstanding service! The team exceeded our expectations with their professionalism, creativity, and quick turnaround time. Highly recommended for anyone seeking quality and reliability.',
                'rating' => 5,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'name' => 'Kristin Watson',
                'title' => 'Global Marketing Director',
                'content' => 'Truly outstanding service! The team exceeded our expectations with their professionalism, creativity, and quick turnaround time. Highly recommended for anyone seeking quality and reliability.',
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
                'slug' => 'mastering-public-speaking-expert-tips',
                'excerpt' => 'Improve your communication skills with proven techniques used by world-class speakers to captivate and inspire audiences.',
                'image' => 'blog/mastering-public-speaking.jpg',
                'content' => "<p>Public speaking is one of the most valuable skills you can develop. Whether you're presenting to a small team or addressing a large conference, the ability to communicate effectively is crucial.</p>\n\n<h3>Preparation is Key</h3>\n<p>Great speakers don't just wing it. They prepare thoroughly, know their material inside and out, and practice until it becomes second nature.</p>\n\n<h3>Connect with Your Audience</h3>\n<p>The best presentations are those where the speaker connects with the audience on an emotional level. Use stories, examples, and relatable content.</p>\n\n<h3>Practice Makes Perfect</h3>\n<p>Rehearse your presentation multiple times. Practice in front of a mirror, record yourself, or present to friends for feedback.</p>",
                'category' => 'Skills',
                'tags' => ['Public Speaking', 'Communication', 'Presentation'],
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'Simple Self-Defense Skills Everyone Should Learn for Safety',
                'slug' => 'simple-self-defense-skills',
                'excerpt' => 'Learn essential self-defense techniques that can help protect you in various situations.',
                'image' => 'blog/self-defense-skills.jpg',
                'content' => "<p>Self-defense is not about being aggressive—it's about being prepared and confident. Here are some fundamental skills everyone should know.</p>\n\n<h3>Awareness is Your First Defense</h3>\n<p>Being aware of your surroundings is the most important self-defense skill. Pay attention to what's happening around you.</p>\n\n<h3>Basic Techniques</h3>\n<p>Learn basic strikes, blocks, and escape techniques. These don't require years of training but can be highly effective.</p>\n\n<h3>Confidence and Assertiveness</h3>\n<p>Projecting confidence can often deter potential threats. Stand tall, make eye contact, and be assertive when necessary.</p>",
                'category' => 'Safety',
                'tags' => ['Self-Defense', 'Safety', 'Skills'],
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'The Power of Networking: Building Connections That Last',
                'slug' => 'power-of-networking-building-connections',
                'excerpt' => 'Discover how to build meaningful professional relationships that can transform your career.',
                'image' => 'blog/networking-power.jpg',
                'content' => "<p>Networking is more than just exchanging business cards. It's about building genuine relationships that can support your career growth.</p>\n\n<h3>Quality Over Quantity</h3>\n<p>It's better to have a few deep, meaningful connections than hundreds of superficial ones. Focus on building genuine relationships.</p>\n\n<h3>Give Before You Get</h3>\n<p>The best networkers give value first. Offer help, share knowledge, and support others before asking for anything in return.</p>\n\n<h3>Follow Up and Stay Connected</h3>\n<p>After meeting someone, follow up within 48 hours. Stay in touch regularly, not just when you need something.</p>",
                'category' => 'Career',
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
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'category' => 'Registration',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => 'Where is the main event venue located precisely?',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'category' => 'Venue',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'question' => 'Can attendees freely switch between sessions and tracks?',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'category' => 'Sessions',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'question' => 'Does the event provide virtual participation options online?',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'category' => 'Virtual',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'question' => 'What is the event refund and cancellation policy?',
                'answer' => 'Our event is designed with flexible scheduling, allowing you to move between halls, select sessions that interest you most, and customize your learning experience throughout the day.',
                'category' => 'Refunds',
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
