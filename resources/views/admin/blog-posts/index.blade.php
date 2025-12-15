@extends('admin.layouts.app')
@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center"><span>All Blog Posts</span><a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Add Post</a></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th width="60">Image</th><th>Title</th><th>Category</th><th>Views</th><th>Status</th><th width="150">Actions</th></tr></thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>@if($post->image)<img src="{{ asset('storage/' . $post->image) }}" class="rounded" style="width:50px;height:50px;object-fit:cover">@else<div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:50px"><i class="bi bi-image text-muted"></i></div>@endif</td>
                        <td><strong>{{ Str::limit($post->title, 40) }}</strong></td>
                        <td>{{ $post->category }}</td>
                        <td>{{ $post->views }}</td>
                        <td><span class="badge {{ $post->is_published ? 'badge-active' : 'badge-inactive' }}">{{ $post->is_published ? 'Published' : 'Draft' }}</span></td>
                        <td>
                            <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty<tr><td colspan="6" class="text-center py-4 text-muted">No posts found</td></tr>@endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($posts->hasPages())<div class="card-footer">{{ $posts->links() }}</div>@endif
</div>
@endsection
