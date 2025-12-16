@extends('admin.layouts.app')
@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3"><label class="form-label">Title *</label><input type="text" class="form-control" name="title" value="{{ old('title', $blogPost->title) }}" required></div>
                <div class="mb-3"><label class="form-label">Excerpt</label><textarea class="form-control" name="excerpt" rows="2">{{ old('excerpt', $blogPost->excerpt) }}</textarea></div>
                <div class="mb-3"><label class="form-label">Content *</label><textarea class="form-control" name="content" rows="10" required>{{ old('content', $blogPost->content) }}</textarea></div>
            </div>
            <div class="col-md-4">
                <div class="mb-3"><label class="form-label">Featured Image</label>@if($blogPost->image)<div class="mb-2"><img src="{{ asset('storage/' . $blogPost->image) }}" class="img-thumbnail" style="max-height:150px"></div>@endif<input type="file" class="form-control" name="image" accept="image/*"></div>
                <div class="mb-3"><label class="form-label">Category</label><input type="text" class="form-control" name="category" value="{{ old('category', $blogPost->category) }}"></div>
                <div class="mb-3"><label class="form-label">Tags (comma-separated)</label><input type="text" class="form-control" name="tags" value="{{ old('tags', is_array($blogPost->tags) ? implode(', ', $blogPost->tags) : '') }}"></div>
                <div class="mb-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', $blogPost->is_published) ? 'checked' : '' }}><label class="form-check-label">Publish</label></div></div>
            </div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Update Post</button></div>
    </form>
</div></div>
@endsection
