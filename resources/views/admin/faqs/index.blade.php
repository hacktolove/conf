@extends('admin.layouts.app')
@section('title', 'FAQs')
@section('page-title', 'FAQs')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center"><span>All FAQs</span><a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add FAQ</a></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>Question</th><th>Category</th><th>Order</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr>
                        <td><strong>{{ Str::limit($faq->question, 60) }}</strong></td>
                        <td>{{ $faq->category }}</td>
                        <td>{{ $faq->order }}</td>
                        <td><span class="badge {{ $faq->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $faq->is_active ? 'Active' : 'Inactive' }}</span></td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="5" class="text-center py-4 text-muted">No FAQs found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
