@extends('admin.layouts.app')
@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')
@section('content')
<div class="card"><div class="card-body">
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
        <div class="row">
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Name *</label><input type="text" class="form-control" name="name" value="{{ old('name', $testimonial->name) }}" required></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Title/Position</label><input type="text" class="form-control" name="title" value="{{ old('title', $testimonial->title) }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Company</label><input type="text" class="form-control" name="company" value="{{ old('company', $testimonial->company) }}"></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Rating *</label><select class="form-select" name="rating" required>@for($i=5;$i>=1;$i--)<option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>{{ $i }} Stars</option>@endfor</select></div></div>
            <div class="col-md-12"><div class="mb-3"><label class="form-label">Content *</label><textarea class="form-control" name="content" rows="4" required>{{ old('content', $testimonial->content) }}</textarea></div></div>
            <div class="col-md-6"><div class="mb-3"><label class="form-label">Photo</label>@if($testimonial->image)<div class="mb-2"><img src="{{ asset('storage/' . $testimonial->image) }}" class="img-thumbnail" style="max-height:100px"></div>@endif<input type="file" class="form-control" name="image" accept="image/*"></div></div>
            <div class="col-md-3"><div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ old('order', $testimonial->order) }}"></div></div>
            <div class="col-md-3"><div class="mb-3 pt-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}><label class="form-check-label">Active</label></div></div></div>
        </div>
        <hr><div class="d-flex justify-content-between"><a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a><button type="submit" class="btn btn-primary">Update</button></div>
    </form>
</div></div>
@endsection
