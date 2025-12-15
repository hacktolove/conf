@extends('admin.layouts.app')
@section('title', 'Edit Gallery Item')
@section('page-title', 'Edit Gallery Item')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
        <div class="row">
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Title</label><input type="text" class="form-control" name="title" value="{{ old('title', $gallery->title) }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Type *</label><select class="form-select" name="type" required><option value="image" {{ $gallery->type == 'image' ? 'selected' : '' }}>Image</option><option value="video" {{ $gallery->type == 'video' ? 'selected' : '' }}>Video</option></select></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Image</label><div class="mb-2"><img src="{{ asset('storage/' . $gallery->image) }}" class="img-thumbnail" style="max-height:100px"></div><input type="file" class="form-control" name="image" accept="image/*"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Video URL</label><input type="url" class="form-control" name="video_url" value="{{ old('video_url', $gallery->video_url) }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Category</label><input type="text" class="form-control" name="category" value="{{ old('category', $gallery->category) }}"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', $gallery->order) }}"></div></div>
            <div class="col-md-3"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Update</button></div>
    </form>
</div></div>
@endsection
