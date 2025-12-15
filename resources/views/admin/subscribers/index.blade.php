@extends('admin.layouts.app')
@section('title', 'Subscribers')
@section('page-title', 'Subscribers')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>All Subscribers ({{ $subscribers->total() }})</span>
        <a href="{{ route('admin.subscribers.export') }}" class="btn btn-success btn-sm"><i class="bi bi-download"></i> Export CSV</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Email</th><th>Status</th><th>Subscribed At</th><th width="100">Actions</th></tr></thead>
                <tbody>
                    @forelse($subscribers as $subscriber)
                    <tr>
                        <td>{{ $subscriber->email }}</td>
                        <td><span class="badge {{ $subscriber->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $subscriber->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>{{ $subscriber->subscribed_at->format('M d, Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subscriber?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="4" class="text-center py-4 text-muted">No subscribers found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($subscribers->hasPages())<div class="card-footer">{{ $subscribers->links() }}</div>@endif
</div>
@endsection
