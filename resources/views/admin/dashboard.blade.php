@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-4 col-xl">
        <div class="stat-card bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $stats['events'] }}</h3>
                    <p class="mb-0 opacity-75">Events</p>
                </div>
                <i class="bi bi-calendar-event" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl">
        <div class="stat-card bg-success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $stats['speakers'] }}</h3>
                    <p class="mb-0 opacity-75">Speakers</p>
                </div>
                <i class="bi bi-people" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl">
        <div class="stat-card bg-warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $stats['blog_posts'] }}</h3>
                    <p class="mb-0 opacity-75">Blog Posts</p>
                </div>
                <i class="bi bi-newspaper" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl">
        <div class="stat-card bg-info">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $stats['subscribers'] }}</h3>
                    <p class="mb-0 opacity-75">Subscribers</p>
                </div>
                <i class="bi bi-envelope" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl">
        <div class="stat-card bg-danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-0">{{ $stats['unread_messages'] }}</h3>
                    <p class="mb-0 opacity-75">New Messages</p>
                </div>
                <i class="bi bi-chat-dots" style="font-size: 2rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Recent Messages</span>
                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $message)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.contact-messages.show', $message) }}">
                                        {{ $message->name }}
                                        @if(!$message->is_read)
                                            <span class="badge bg-danger">New</span>
                                        @endif
                                    </a>
                                </td>
                                <td>{{ Str::limit($message->subject, 30) }}</td>
                                <td>{{ $message->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">No messages yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Recent Subscribers</span>
                <a href="{{ route('admin.subscribers.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSubscribers as $subscriber)
                            <tr>
                                <td>{{ $subscriber->email }}</td>
                                <td>{{ $subscriber->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center py-4 text-muted">No subscribers yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
