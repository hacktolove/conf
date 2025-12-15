@extends('admin.layouts.app')
@section('title', 'Add Blog Post')
@section('page-title', 'Add Blog Post')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">@csrf
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3"><label class="form-label">Title *</label><input type="text" class="form-control" name="title" value="{{ old('title') }}" required></div>
                <div class="mb-3"><label class="form-label">Excerpt</label><textarea class="form-control" name="excerpt" rows="2">{{ old('excerpt') }}</textarea></div>
                <div class="mb-3"><label class="form-label">Content *</label><textarea class="form-control" name="content" rows="10" required>{{ old('content') }}</textarea></div>
            </div>
            <div class="col-md-4">
                <div class="mb-3"><label class="form-label">Featured Image</label><input type="file" class="form-control" name="image" accept="image/*"></div>
                <div class="mb-3"><label class="form-label">Category</label><input type="text" class="form-control" name="category" value="{{ old('category') }}"></div>
                <div class="mb-3"><label class="form-label">Tags (comma-separated)</label><input type="text" class="form-control" name="tags" value="{{ old('tags') }}"></div>
                <div class="mb-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}><label class="form-check-label">Publish</label></div></div>
            </div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Create Post</button></div>
    </form>
</div></div>
@endsection
