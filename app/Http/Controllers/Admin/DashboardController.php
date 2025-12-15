<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Speaker;
use App\Models\BlogPost;
use App\Models\Subscriber;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'events' => Event::count(),
            'speakers' => Speaker::count(),
            'blog_posts' => BlogPost::count(),
            'subscribers' => Subscriber::count(),
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentSubscribers = Subscriber::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentSubscribers'));
    }
}
