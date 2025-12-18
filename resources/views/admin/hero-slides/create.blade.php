@extends('admin.layouts.app')

@section('title', 'Add Hero Slide')
@section('page-title', 'Add Hero Slide')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Subtitle</label>
                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text" class="form-label">Button 1 Text</label>
                                <input type="text" class="form-control" id="button_text" name="button_text" value="{{ old('button_text') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_link" class="form-label">Button 1 Link</label>
                                <input type="text" class="form-control" id="button_link" name="button_link" value="{{ old('button_link') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text_2" class="form-label">Button 2 Text</label>
                                <input type="text" class="form-control" id="button_text_2" name="button_text_2" value="{{ old('button_text_2') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_link_2" class="form-label">Button 2 Link</label>
                                <input type="text" class="form-control" id="button_link_2" name="button_link_2" value="{{ old('button_link_2') }}">
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h6 class="mb-3">Arabic Content</h6>
                    <div class="mb-3">
                        <label for="title_ar" class="form-label">Title (Arabic)</label>
                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" dir="rtl">
                    </div>
                    <div class="mb-3">
                        <label for="subtitle_ar" class="form-label">Subtitle (Arabic)</label>
                        <input type="text" class="form-control" id="subtitle_ar" name="subtitle_ar" value="{{ old('subtitle_ar') }}" dir="rtl">
                    </div>
                    <div class="mb-3">
                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                        <textarea class="form-control" id="description_ar" name="description_ar" rows="3" dir="rtl">{{ old('description_ar') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text_ar" class="form-label">Button 1 Text (Arabic)</label>
                                <input type="text" class="form-control" id="button_text_ar" name="button_text_ar" value="{{ old('button_text_ar') }}" dir="rtl">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text_2_ar" class="form-label">Button 2 Text (Arabic)</label>
                                <input type="text" class="form-control" id="button_text_2_ar" name="button_text_2_ar" value="{{ old('button_text_2_ar') }}" dir="rtl">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Background Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="video_url" class="form-label">Video URL (Optional)</label>
                        <input type="url" class="form-control" id="video_url" name="video_url" value="{{ old('video_url') }}">
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Slide</button>
            </div>
        </form>
    </div>
</div>
@endsection
