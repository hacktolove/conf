@extends('admin.layouts.app')

@section('title', 'Events')
@section('page-title', 'Events')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Events</span>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Add Event
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="60">Image</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td>
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $event->title }}</strong>
                            @if($event->is_featured)
                                <span class="badge bg-warning">Featured</span>
                            @endif
                        </td>
                        <td>{{ $event->event_date->format('M d, Y') }}</td>
                        <td>{{ $event->venue }}</td>
                        <td>
                            <span class="badge {{ $event->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $event->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No events found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($events->hasPages())
    <div class="card-footer">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection
