@extends('admin.layouts.app')
@section('title', 'Edit News')
@section('page-title', 'Edit News')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <h6 class="mb-3">English Content</h6>
                <div class="mb-3"><label class="form-label">Title *</label><input type="text" class="form-control" name="title" value="{{ old('title', $news->title) }}" required></div>
                <div class="mb-3"><label class="form-label">Body *</label><textarea class="form-control" name="body" rows="10" required>{{ old('body', $news->body) }}</textarea></div>
                <hr class="my-4">
                <h6 class="mb-3">Arabic Content</h6>
                <div class="mb-3"><label class="form-label">Title (Arabic)</label><input type="text" class="form-control" name="title_ar" value="{{ old('title_ar', $news->title_ar) }}" dir="rtl"></div>
                <div class="mb-3"><label class="form-label">Body (Arabic)</label><textarea class="form-control" name="body_ar" rows="10" dir="rtl">{{ old('body_ar', $news->body_ar) }}</textarea></div>
            </div>
            <div class="col-md-4">
                <div class="mb-3"><label class="form-label">Featured Image</label>@if($news->image)<div class="mb-2"><img src="{{ asset('storage/' . $news->image) }}" class="img-thumbnail" style="max-height:150px"></div>@endif<input type="file" class="form-control" name="image" accept="image/*"></div>
                <div class="mb-3"><label class="form-label">Date *</label><input type="date" class="form-control" name="date" value="{{ old('date', $news->date->format('Y-m-d')) }}" required></div>
                <div class="mb-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}><label class="form-check-label">Publish</label></div></div>
            </div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Update News</button></div>
    </form>
</div></div>
@endsection

