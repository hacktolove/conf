<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Speaker;
use App\Models\Schedule;
use App\Models\BlogPost;
use App\Models\News;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Statistic;
use App\Models\Subscriber;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Get all active hero slides ordered by order field
        $heroSlides = HeroSlide::active()->orderBy('order')->get();
        $events = Event::active()->upcoming()->orderBy('event_date')->take(6)->get();
        $speakers = Speaker::active()->featured()->orderBy('order')->take(8)->get();
        $schedules = Schedule::with(['event', 'speakers'])->active()->orderBy('schedule_date')->orderBy('start_time')->get();
        $galleries = Gallery::active()->orderBy('order')->take(8)->get();
        $news = News::published()->recent()->take(10)->get();

        // Get countdown date from site settings (dynamic from database)
        $countdownDateRaw = SiteSetting::get('countdown_date');
        if ($countdownDateRaw) {
            // Use database value if set
            $countdownDate = Carbon::parse($countdownDateRaw)->format('Y-m-d H:i:s');
            $hasCountdown = true;
        } else {
            // Fallback to default if not set in database
            $countdownDate = now()->addMonths(3)->format('Y-m-d H:i:s');
            $hasCountdown = true;
        }
        $mission = SiteSetting::get('mission', 'Our mission is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.');
        $vision = SiteSetting::get('vision', 'Our vision is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.');
        $goal = SiteSetting::get('goal', 'Our goal is to build a global community where collaboration fuels innovation we aim encourage fresh thinking, spark inspiring dialogues, and create a space.');

        // Get speaker reveal data from site settings
        $speakerRevealDate = SiteSetting::get('speaker_reveal_date', now()->addDays(7)->format('Y-m-d H:i:s'));
        $speakerRevealId = SiteSetting::get('speaker_reveal_speaker_id');
        $upcomingSpeaker = null;
        $showSpeaker = false;

        if ($speakerRevealDate && $speakerRevealId) {
            // Calculate time remaining until reveal date
            $revealDateTime = Carbon::parse($speakerRevealDate);
            $now = Carbon::now();
            $hoursRemaining = $now->diffInHours($revealDateTime, false);

            // Show speaker only if less than 1 hour remaining until reveal date
            // (negative value means reveal date has passed, which we also show)
            if ($hoursRemaining <= 1) {
                $upcomingSpeaker = Speaker::active()->find($speakerRevealId);
                $showSpeaker = $upcomingSpeaker !== null;
            }
        }

        return view('frontend.home', compact(
            'heroSlides', 'events', 'speakers', 'schedules',
            'galleries', 'news', 'countdownDate', 'hasCountdown', 'mission', 'vision', 'goal',
            'speakerRevealDate', 'upcomingSpeaker', 'showSpeaker'
        ));
    }

    public function about()
    {
        $speakers = Speaker::active()->orderBy('order')->get();
        $statistics = Statistic::active()->orderBy('order')->get();

        return view('frontend.about', compact('speakers', 'statistics'));
    }

    public function events()
    {
        $events = Event::active()->orderBy('event_date', 'desc')->paginate(9);
        return view('frontend.events.index', compact('events'));
    }

    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)->with(['schedules.speakers'])->firstOrFail();
        return view('frontend.events.show', compact('event'));
    }

    public function speakers()
    {
        $speakers = Speaker::active()->orderBy('order')->paginate(12);
        return view('frontend.speakers.index', compact('speakers'));
    }

    public function speakerDetail($slug)
    {
        $speaker = Speaker::where('slug', $slug)->with(['schedules.event'])->firstOrFail();
        return view('frontend.speakers.show', compact('speaker'));
    }

    public function schedule()
    {
        $schedules = Schedule::with(['event', 'speakers'])->active()
            ->orderBy('schedule_date')->orderBy('start_time')->get();

        return view('frontend.schedule', compact('schedules'));
    }

    public function blog()
    {
        $posts = BlogPost::published()->recent()->paginate(9);
        return view('frontend.blog.index', compact('posts'));
    }

    public function blogDetail($slug)
    {
        $post = BlogPost::where('slug', $slug)->published()->firstOrFail();
        $post->increment('views');
        $recentPosts = BlogPost::published()->where('id', '!=', $post->id)->recent()->take(3)->get();

        return view('frontend.blog.show', compact('post', 'recentPosts'));
    }

    public function newsDetail($slug)
    {
        $news = News::where('slug', $slug)->published()->firstOrFail();
        $news->increment('views');
        $recentNews = News::published()->where('id', '!=', $news->id)->recent()->take(3)->get();

        return view('frontend.news.show', compact('news', 'recentNews'));
    }

    public function gallery()
    {
        $galleries = Gallery::active()->orderBy('order')->paginate(12);
        return view('frontend.gallery', compact('galleries'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email'
        ]);

        Subscriber::create([
            'email' => $request->email,
            'subscribed_at' => now()
        ]);

        return back()->with('success', 'Thank you for subscribing!');
    }
}
