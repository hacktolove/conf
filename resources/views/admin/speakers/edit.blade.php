@extends('admin.layouts.app')

@section('title', 'Edit Speaker')
@section('page-title', 'Edit Speaker')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.speakers.update', $speaker) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <h6 class="mb-3">English Content</h6>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $speaker->name) }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title/Position</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $speaker->title) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $speaker->company) }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Biography</label>
                        <textarea class="form-control" id="bio" name="bio" rows="5">{{ old('bio', $speaker->bio) }}</textarea>
                    </div>
                    <hr class="my-4">
                    <h6 class="mb-3">Arabic Content</h6>
                    <div class="mb-3">
                        <label for="name_ar" class="form-label">Name (Arabic)</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ old('name_ar', $speaker->name_ar) }}" dir="rtl">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title_ar" class="form-label">Title/Position (Arabic)</label>
                                <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $speaker->title_ar) }}" dir="rtl">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="company_ar" class="form-label">Company (Arabic)</label>
                                <input type="text" class="form-control" id="company_ar" name="company_ar" value="{{ old('company_ar', $speaker->company_ar) }}" dir="rtl">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio_ar" class="form-label">Biography (Arabic)</label>
                        <textarea class="form-control" id="bio_ar" name="bio_ar" rows="5" dir="rtl">{{ old('bio_ar', $speaker->bio_ar) }}</textarea>
                    </div>
                    <h6 class="mb-3">Social Links</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="url" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $speaker->facebook) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="url" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $speaker->twitter) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin', $speaker->linkedin) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="url" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $speaker->instagram) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">Photo</label>
                        @if($speaker->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $speaker->image) }}" alt="" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="order" class="form-label">Order</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $speaker->order) }}">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $speaker->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Featured</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $speaker->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.speakers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Speaker</button>
            </div>
        </form>
    </div>
</div>
@endsection
