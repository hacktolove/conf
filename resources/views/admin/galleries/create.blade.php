@extends('admin.layouts.app')
@section('title', 'Add Gallery Item')
@section('page-title', 'Add Gallery Item')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">@csrf
        <div class="row">
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Title</label><input type="text" class="form-control" name="title" value="{{ old('title') }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Type *</label><select class="form-select" name="type" required><option value="image">Image</option><option value="video">Video</option></select></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Image *</label><input type="file" class="form-control" name="image" accept="image/*" required></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Video URL (for video type)</label><input type="url" class="form-control" name="video_url" value="{{ old('video_url') }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Category</label><input type="text" class="form-control" name="category" value="{{ old('category') }}"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', 0) }}"></div></div>
            <div class="col-md-3"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Create</button></div>
    </form>
</div></div>
@endsection
