@extends('admin.layouts.app')
@section('title', 'Schedules')
@section('page-title', 'Schedules')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Schedules</span>
        <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add Schedule</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Title</th><th>Event</th><th>Speaker</th><th>Date</th><th>Time</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($schedules as $schedule)
                    <tr>
                        <td><strong>{{ $schedule->title }}</strong></td>
                        <td>{{ $schedule->event->title ?? 'N/A' }}</td>
                        <td>{{ $schedule->speaker->name ?? 'N/A' }}</td>
                        <td>{{ $schedule->schedule_date->format('M d, Y') }}</td>
                        <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td><span class="badge {{ $schedule->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $schedule->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-4 text-muted">No schedules found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($schedules->hasPages())<div class="card-footer">{{ $schedules->links() }}</div>@endif
</div>
@endsection
