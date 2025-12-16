@extends('admin.layouts.app')
@section('title', 'Contact Messages')
@section('page-title', 'Contact Messages')
@section('content')
<div class="card">
    <div class="card-header"><span>All Messages</span></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($messages as $message)
                    <tr class="{{ !$message->is_read ? 'table-warning' : '' }}">
                        <td><strong>{{ $message->name }}</strong></td>
                        <td>{{ $message->email }}</td>
                        <td>{{ Str::limit($message->subject, 30) }}</td>
                        <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                        <td><span class="badge {{ $message->is_read ? 'bg-secondary' : 'bg-warning text-dark' }}">{{ $message->is_read ? 'Read' : 'New' }}</span></td>
                        <td>
                            <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                            <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="6" class="text-center py-4 text-muted">No messages found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($messages->hasPages())<div class="card-footer">{{ $messages->links() }}</div>@endif
</div>
@endsection
