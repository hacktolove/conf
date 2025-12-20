<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\Schedule;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\Faq;

class ArabicContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->updateHeroSlides();
        $this->updateEvents();
        $this->updateSpeakers();
        $this->updateSchedules();
        $this->updateBlogPosts();
        $this->updateTestimonials();
        $this->updateFaqs();

        $this->command->info('Arabic content has been successfully added to all existing records!');
    }

    /**
     * Update hero slides with Arabic content
     */
    private function updateHeroSlides(): void
    {
        $heroSlides = HeroSlide::all();

        foreach ($heroSlides as $slide) {
            // Only update if Arabic fields are empty
            if (empty($slide->title_ar)) {
                $slide->update([
                    'title_ar' => $this->translateToArabic($slide->title),
                    'subtitle_ar' => $slide->subtitle ? $this->translateToArabic($slide->subtitle) : null,
                    'description_ar' => $slide->description ? $this->translateToArabic($slide->description) : null,
                    'button_text_ar' => $slide->button_text ? $this->translateToArabic($slide->button_text) : null,
                    'button_text_2_ar' => $slide->button_text_2 ? $this->translateToArabic($slide->button_text_2) : null,
                ]);
            }
        }

        $this->command->info('Hero slides updated with Arabic content.');
    }

    /**
     * Update events with Arabic content
     */
    private function updateEvents(): void
    {
        $events = Event::all();

        foreach ($events as $event) {
            if (empty($event->title_ar)) {
                $event->update([
                    'title_ar' => $this->translateToArabic($event->title),
                    'short_description_ar' => $event->short_description ? $this->translateToArabic($event->short_description) : null,
                    'description_ar' => $event->description ? $this->translateToArabic($event->description) : null,
                    'venue_ar' => $event->venue ? $this->translateToArabic($event->venue) : null,
                    'address_ar' => $event->address ? $this->translateToArabic($event->address) : null,
                ]);
            }
        }

        $this->command->info('Events updated with Arabic content.');
    }

    /**
     * Update speakers with Arabic content
     */
    private function updateSpeakers(): void
    {
        $speakers = Speaker::all();

        foreach ($speakers as $speaker) {
            if (empty($speaker->name_ar)) {
                $speaker->update([
                    'name_ar' => $this->translateToArabic($speaker->name),
                    'title_ar' => $speaker->title ? $this->translateToArabic($speaker->title) : null,
                    'company_ar' => $speaker->company ? $this->translateToArabic($speaker->company) : null,
                    'bio_ar' => $speaker->bio ? $this->translateToArabic($speaker->bio) : null,
                ]);
            }
        }

        $this->command->info('Speakers updated with Arabic content.');
    }

    /**
     * Update schedules with Arabic content
     */
    private function updateSchedules(): void
    {
        $schedules = Schedule::all();

        foreach ($schedules as $schedule) {
            if (empty($schedule->title_ar)) {
                $schedule->update([
                    'title_ar' => $this->translateToArabic($schedule->title),
                    'description_ar' => $schedule->description ? $this->translateToArabic($schedule->description) : null,
                    'venue_ar' => $schedule->venue ? $this->translateToArabic($schedule->venue) : null,
                    'day_label_ar' => $schedule->day_label ? $this->translateToArabic($schedule->day_label) : null,
                ]);
            }
        }

        $this->command->info('Schedules updated with Arabic content.');
    }

    /**
     * Update blog posts with Arabic content
     */
    private function updateBlogPosts(): void
    {
        $posts = BlogPost::all();

        foreach ($posts as $post) {
            if (empty($post->title_ar)) {
                $post->update([
                    'title_ar' => $this->translateToArabic($post->title),
                    'excerpt_ar' => $post->excerpt ? $this->translateToArabic($post->excerpt) : null,
                    'content_ar' => $post->content ? $this->translateToArabic($post->content) : null,
                    'category_ar' => $post->category ? $this->translateToArabic($post->category) : null,
                ]);
            }
        }

        $this->command->info('Blog posts updated with Arabic content.');
    }

    /**
     * Update testimonials with Arabic content
     */
    private function updateTestimonials(): void
    {
        $testimonials = Testimonial::all();

        foreach ($testimonials as $testimonial) {
            if (empty($testimonial->name_ar)) {
                $testimonial->update([
                    'name_ar' => $this->translateToArabic($testimonial->name),
                    'title_ar' => $testimonial->title ? $this->translateToArabic($testimonial->title) : null,
                    'company_ar' => $testimonial->company ? $this->translateToArabic($testimonial->company) : null,
                    'content_ar' => $testimonial->content ? $this->translateToArabic($testimonial->content) : null,
                ]);
            }
        }

        $this->command->info('Testimonials updated with Arabic content.');
    }

    /**
     * Update FAQs with Arabic content
     */
    private function updateFaqs(): void
    {
        $faqs = Faq::all();

        foreach ($faqs as $faq) {
            if (empty($faq->question_ar)) {
                $faq->update([
                    'question_ar' => $this->translateToArabic($faq->question),
                    'answer_ar' => $faq->answer ? $this->translateToArabic($faq->answer) : null,
                    'category_ar' => $faq->category ? $this->translateToArabic($faq->category) : null,
                ]);
            }
        }

        $this->command->info('FAQs updated with Arabic content.');
    }

    /**
     * Translate English text to Arabic using the helper
     */
    private function translateToArabic(?string $text): ?string
    {
        return ArabicTranslationHelper::translate($text);
    }
}
