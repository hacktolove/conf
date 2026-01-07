@extends('admin.layouts.app')
@section('title', 'News')
@section('page-title', 'News')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center"><span>All News</span><a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add News</a></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th width="60">Image</th><th>Title</th><th>Date</th><th>Views</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>@if($item->image)<img src="{{ asset('storage/' . $item->image) }}" class="rounded" style="width:50px;height:50px;object-fit:cover">@else<div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:50px"><i class="bi bi-image text-muted"></i></div>@endif</td>
                        <td><strong>{{ Str::limit($item->title, 40) }}</strong></td>
                        <td>{{ $item->date->format('M d, Y') }}</td>
                        <td>{{ $item->views }}</td>
                        <td><span class="badge {{ $item->is_published ? 'badge-active' : 'badge-inactive' }}">{{ $item->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="6" class="text-center py-4 text-muted">No news found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($news->hasPages())<div class="card-footer">{{ $news->links() }}</div>@endif
</div>
@endsection

